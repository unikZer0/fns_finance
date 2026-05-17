# FNS Finance — API Specification

## Base Information

- **Base URL:** `http://localhost:8000` (development)
- **API Style:** Traditional Laravel web routes (Blade views)
- **Authentication:** Session-based (Laravel Breeze)
- **Response Format:** HTML views or JSON for AJAX endpoints

## Authentication System

### POST /login
**Description:** User login with username

**Request:**
```php
[
    'username' => 'required|string',
    'password' => 'required|string',
]
```

**Response:** Redirect to role-specific dashboard

**Middleware:** `guest`

**Notes:**
- Checks `is_active` status before login
- Auto-logout if account is inactive
- Uses `username` field (NOT email)

### POST /logout
**Description:** User logout

**Response:** Redirect to login page

**Middleware:** `auth`

---

## Common Routes (All Roles)

### GET /dashboard
**Description:** Smart redirect to role-specific home page

**Response:** Redirects based on user role
- `admin` → `/admin/home`
- `head_of_finance` → `/head-of-finance/home`
- `head_of_department` → `/head-of-department/home`
- `deputy_head_of_faculty` → `/deputy-head-of-faculty/home`
- `head_of_faculty` → `/head-of-faculty/home`
- `accountant` → `/accountant/home`

**Middleware:** `auth`, `check.active`

### Profile Management
- `GET /profile` — Edit profile form
- `PATCH /profile` — Update profile
- `DELETE /profile` — Delete account

### Notification Endpoints
#### GET /notifications/data
**Description:** Get user notifications

**Response:** JSON
```json
{
  "unread_count": 5,
  "notifications": [
    {
      "id": "uuid",
      "message": "string",
      "url": "string",
      "read": false,
      "time": "2 hours ago"
    }
  ]
}
```

#### POST /notifications/{id}/read
**Description:** Mark single notification as read

**Response:** `{"success": true}`

#### POST /notifications/read-all
**Description:** Mark all notifications as read

**Response:** `{"success": true}`

---

## Admin Routes (`/admin/*`)

**Middleware:** `auth`, `check.active`, `role:admin`

### Users CRUD
#### GET /admin/users
**Description:** List all users with filters

**Query Parameters:**
- `role` — Filter by role_id
- `department` — Filter by department_id
- `status` — Filter by is_active (0/1)

**Response:** View with user table

#### POST /admin/users
**Description:** Create new user

**Request:**
```php
[
    'username' => 'required|unique:users',
    'password' => 'required|min:8',
    'full_name' => 'required',
    'role_id' => 'required|exists:roles,id',
    'department_id' => 'nullable|exists:departments,id',
    'is_active' => 'boolean',
]
```

#### PUT /admin/users/{user}
**Description:** Update user

**Request:** Same as create (except password optional)

#### DELETE /admin/users/{user}
**Description:** Delete user (prevents self-deletion)

### Roles CRUD
- `GET /admin/roles` — List roles with user counts
- `POST /admin/roles` — Create role
- `PUT /admin/roles/{role}` — Update role
- `DELETE /admin/roles/{role}` — Delete role (prevents if users exist)

### Departments CRUD
- `GET /admin/departments` — List departments with user counts
- `POST /admin/departments` — Create department
- `PUT /admin/departments/{department}` — Update department
- `DELETE /admin/departments/{department}` — Delete department

### Chart of Accounts CRUD
- `GET /admin/chart-of-accounts` — List hierarchical accounts
- `POST /admin/chart-of-accounts` — Create account
- `PUT /admin/chart-of-accounts/{chartOfAccount}` — Update account
- `DELETE /admin/chart-of-accounts/{chartOfAccount}` — Delete account

**Request:**
```php
[
    'account_code' => 'required|digits:8|unique:chart_of_accounts',
    'account_name' => 'required',
    'parent_id' => 'nullable|exists:chart_of_accounts,id',
]
```

---

## Head of Finance Routes (`/head-of-finance/*`)

**Middleware:** `auth`, `check.active`, `role:head_of_finance`

### Annual Budget Plans
#### GET /head-of-finance/annual-budget
**Description:** List all budget plans

#### GET /head-of-finance/annual-budget/create
**Description:** Create new budget plan form

#### POST /head-of-finance/annual-budget
**Description:** Create new budget plan

**Request:**
```php
[
    'fiscal_year' => 'required|integer|min:2000|max:9999|unique:budget_plans,fiscal_year',
]
```

#### GET /head-of-finance/annual-budget/{annualBudget}
**Description:** Show budget plan details with line items

**Response:** View with:
- Budget plan info
- Line items table (hierarchical roll-up)
- Reviewer assignments
- Comments
- Action buttons (based on status)

#### GET /head-of-finance/annual-budget/{annualBudget}/preview
**Description:** Preview for printing

#### GET /head-of-finance/annual-budget/{annualBudget}/pdf
**Description:** Export as PDF (A4 Landscape, Lao font)

**Response:** PDF file download

#### PUT /head-of-finance/annual-budget/{annualBudget}
**Description:** Update budget plan

#### DELETE /head-of-finance/annual-budget/{annualBudget}
**Description:** Delete budget plan (with line items and allocations)

### Budget Line Items
#### POST /head-of-finance/annual-budget/{annualBudget}/items
**Description:** Add single line item

**Request:**
```php
[
    'account_id' => 'required|exists:chart_of_accounts,id',
    'amount_regular' => 'nullable|numeric|min:0',
    'amount_academic' => 'nullable|numeric|min:0',
]
```

**Validation:** Account must be leaf node (no children)

#### POST /head-of-finance/annual-budget/{annualBudget}/items/bulk
**Description:** Bulk add line items

**Request:**
```php
[
    'items' => 'required|array',
    'items.*.account_id' => 'nullable|exists:chart_of_accounts,id',
    'items.*.amount_regular' => 'nullable|numeric|min:0',
    'items.*.amount_academic' => 'nullable|numeric|min:0',
]
```

#### PUT /head-of-finance/annual-budget/{annualBudget}/items/{item}
**Description:** Update line item amount

#### DELETE /head-of-finance/annual-budget/{annualBudget}/items/{item}
**Description:** Delete line item (with period allocations)

### Budget Workflow Actions
#### POST /head-of-finance/annual-budget/{annualBudget}/submit
**Description:** Submit for review (DRAFT/MODIFYING → PENDING_REVIEW)

**Request:**
```php
[
    'reviewer_ids' => 'required|array|min:1',
    'reviewer_ids.*' => 'exists:users,id',
]
```

**Side Effects:**
- Creates reviewer assignments
- Increments `submission_round`
- Sends notifications to reviewers

#### POST /head-of-finance/annual-budget/{annualBudget}/unsubmit
**Description:** Cancel submission (PENDING_REVIEW → MODIFYING)

#### POST /head-of-finance/annual-budget/{annualBudget}/start-modifying
**Description:** Start editing (PENDING_REVIEW → MODIFYING)

#### POST /head-of-finance/annual-budget/{annualBudget}/submit-final
**Description:** Submit for final approval (MODIFYING → PENDING_FINAL_APPROVAL)

**Side Effects:**
- Sends notifications to all Head of Faculty users

#### POST /head-of-finance/annual-budget/{annualBudget}/auto-populate
**Description:** Auto-populate from Salary and Expense plans

**Side Effects:**
- Replaces existing line items
- Aggregates data from approved plans

### Budget Comments
#### POST /head-of-finance/annual-budget/{annualBudget}/comments/{comment}/mark
**Description:** Toggle comment mark status

**Response:** JSON
```json
{
  "marked": true,
  "markedBy": "Full Name",
  "markedAt": "13/05/2026 14:30"
}
```

### Budget Installments
#### GET /head-of-finance/budget-installment
**Description:** List budget plans for installment allocation

#### GET /head-of-finance/budget-installment/{budgetPlan}
**Description:** Show installment allocation form (periods 1-2)

#### GET /head-of-finance/budget-installment/{budgetPlan}/preview
**Description:** Preview official document (A4 Landscape)

#### POST /head-of-finance/budget-installment/{budgetPlan}/save
**Description:** Save installment allocations

**Request:**
```php
[
    'allocations' => 'required|array',
    'allocations.*.line_item_id' => 'required|exists:budget_line_items,id',
    'allocations.*.period_1' => 'required|numeric|min:0',
    'allocations.*.period_2' => 'required|numeric|min:0',
]
```

**Validation:** 
- Period 1 = 6 months (Jan-Jun)
- Period 2 = 6 months (Jul-Dec)
- Total must match annual amount

#### GET /head-of-finance/budget-installment-34/{budgetPlan}
**Description:** Budget revision form (periods 3-4)

**Validation:** Total adjustments ≤ 100% of original

### Planning Modules

#### Academic Income Plans
- `GET /head-of-finance/academic-income` — List plans
- `POST /head-of-finance/academic-income` — Create plan

**Request (Create Plan):**
```php
[
    'fiscal_year' => 'required|integer|min:2000|max:9999|unique:academic_income_plans,fiscal_year',
    'government_doc_id' => 'nullable|string|max:255', // ເລກທີເອກະສານຈາກລັດຖະບານ
    'plan_start_year' => 'nullable|integer|min:2000|max:9999', // ແຜນເລີ່ມຕົ້ນປີ ທີ
    'notes' => 'nullable|string', // ໝາຍເຫດ
]
```

**Plan Settings (via Settings Modal):**
```php
[
    'government_doc_id' => 'nullable|string|max:255',
    'plan_start_year' => 'nullable|integer|min:2000|max:9999',
    'notes' => 'nullable|string',
    'price_per_credit' => 'required|numeric|min:1',
    'teaching_rate_bachelor' => 'required|numeric|min:0|max:1',
    'teaching_rate_masters_phd' => 'required|numeric|min:0|max:1',
]
```

**Response:** Redirects to plan detail page

**Access Control:** All academic-income routes require `role:head_of_finance` middleware

- `GET /head-of-finance/academic-income/{plan}` — Show details with degree-level breakdown
- `DELETE /head-of-finance/academic-income/{plan}` — Delete plan
- `GET /head-of-finance/academic-income/{plan}/summary` — Summary view by degree
- `GET /head-of-finance/academic-income/{plan}/pdf` — Export PDF with degree breakdown
- `POST /head-of-finance/academic-income/{plan}/approve` — Mark as approved
- `POST /head-of-finance/academic-income/{plan}/revert-draft` — Revert to draft
- `POST /head-of-finance/academic-income/{plan}/save-all` — Bulk save all items with degree separation

#### Academic Income Evaluation (Degree-Level Input)
- `GET /head-of-finance/academic-income/{plan}/evaluate` — Evaluation form with degree inputs
- `POST /head-of-finance/academic-income/{plan}/evaluate` — Save evaluation data by degree
- `GET /head-of-finance/academic-income/{plan}/evaluate/preview` — Preview evaluation before saving

**Evaluation Form Structure:**
```
Section 1.1 - Bachelor Courses (ປີ 2-4)
├─ ປີ 2 ວິທະຍາສາດຄອມ (37 credits)
│  ├─ Bachelor: [60] students × [37] credits × rate
│  ├─ Master:   [5] students × rate
│  └─ PhD:      [2] students × rate
└─ ປີ 2 ພັດທະນາໂປຣແກຣມ (38 credits)
   ├─ Bachelor: [70] students × [38] credits × rate
   └─ Master:   [10] students × rate
```

#### Academic Income Management Settings (Income Assessment Management)
These routes manage the structured settings that drive the Academic Income Assessment calculations (sections 1.1–1.4).

##### Credit Unit Price Setting (ราคาต่อหน่วยกิตของหลักสูตร)
- `GET /head-of-finance/settings/credit-unit-price` — List credit unit prices
- `POST /head-of-finance/settings/credit-unit-price` — Create credit unit price entry
- `PUT /head-of-finance/settings/credit-unit-price/{setting}` — Update credit unit price
- `DELETE /head-of-finance/settings/credit-unit-price/{setting}` — Delete entry

**Request:**
```php
[
    'degree_program_id' => 'required|exists:degree_programs,id',
    'credit_unit_price' => 'required|numeric|min:0',
    'gov_doc_id' => 'nullable|string|max:255', // ເລກທີເອກະສານຈາກລັດຖະບານ
    'start_year' => 'required|integer|min:2000|max:9999',
]
```

##### Course Credit Unit Setting (จำนวนหน่วยกิตของหลักสูตร)
- `GET /head-of-finance/settings/course-credits` — List course credits
- `POST /head-of-finance/settings/course-credits` — Create course credit entry
- `PUT /head-of-finance/settings/course-credits/{setting}` — Update course credits
- `DELETE /head-of-finance/settings/course-credits/{setting}` — Delete entry

**Request:**
```php
[
    'degree_program_id' => 'required|exists:degree_programs,id',
    'course_credit_unit' => 'required|integer|min:1',
    'gov_doc_id' => 'nullable|string|max:255',
    'start_year' => 'required|integer|min:2000|max:9999',
]
```

##### Payment Installment Setting (เปอร์เซ็นต์การชำระเงิน 60/40)
- `GET /head-of-finance/settings/installments` — List installment percentages
- `POST /head-of-finance/settings/installments` — Create installment entry
- `PUT /head-of-finance/settings/installments/{setting}` — Update installment percentages
- `DELETE /head-of-finance/settings/installments/{setting}` — Delete entry

**Request:**
```php
[
    'degree_program_id' => 'required|exists:degree_programs,id',
    'first_payment_percent' => 'required|numeric|min:0|max:100',
    'second_payment_percent' => 'required|numeric|min:0|max:100',
    'start_year' => 'required|integer|min:2000|max:9999',
]
```

**Validation:** `first_payment_percent + second_payment_percent` must equal `100`

##### Registration Fee Setting (ค่าลงทะเบียน — ใช้ในข้อ 1.2 และ 1.4)
- `GET /head-of-finance/settings/registration-fee` — List registration fee rates
- `POST /head-of-finance/settings/registration-fee` — Create registration fee entry
- `PUT /head-of-finance/settings/registration-fee/{setting}` — Update registration fee
- `DELETE /head-of-finance/settings/registration-fee/{setting}` — Delete entry

**Request:**
```php
[
    'degree_program_id' => 'required|exists:degree_programs,id',
    'registration_fee_rate' => 'required|numeric|min:0',
    'gov_doc_id' => 'nullable|string|max:255',
    'start_year' => 'required|integer|min:2000|max:9999',
]
```

#### Salary Plans
- `GET /head-of-finance/salary` — List plans
- `POST /head-of-finance/salary` — Create plan
- `GET /head-of-finance/salary/{plan}` — Show details
- `DELETE /head-of-finance/salary/{plan}` — Delete plan
- `GET /head-of-finance/salary/{plan}/summary` — Summary view
- `GET /head-of-finance/salary/{plan}/pdf` — Export PDF
- `POST /head-of-finance/salary/{plan}/approve` — Mark as approved

#### Expense Plans
- `GET /head-of-finance/expense` — List plans
- `POST /head-of-finance/expense` — Create plan
- `GET /head-of-finance/expense/{plan}` — Show details
- `DELETE /head-of-finance/expense/{plan}` — Delete plan
- `GET /head-of-finance/expense/{plan}/summary` — Summary view
- `GET /head-of-finance/expense/{plan}/pdf` — Export PDF
- `POST /head-of-finance/expense/{plan}/approve` — Mark as approved
- `POST /head-of-finance/expense/{plan}/auto-fill-25` — Auto-fill 25% allocation
- `GET /head-of-finance/expense/{plan}/balance` — Balance calculation

##### POST /head-of-finance/expense/{plan}/save-all
**Description:** Bulk save expense items with section codes (e.g., "2.1", "2.1.1") and Chart of Account mapping

**Request:**
```php
[
    'items' => 'required|array',
    'items.*.section_code' => 'required|string', // e.g., "2.1.1"
    'items.*.section_name' => 'required|string', // e.g., "ບໍລິຫານສັງລວມ"
    'items.*.chart_of_account_id' => 'required|exists:chart_of_accounts,id',
    'items.*.description' => 'nullable|string|max:255',
    'items.*.amount' => 'required|numeric|min:0',
    'items.*.sort_order' => 'nullable|integer|min:0',
]
```

**Notes:**
- `section_code` ໃຊ້ສຳລັບການຈັດກຸ່ມ (Group) ໃນ Report/PDF preview ເຊັ່ນ ລວມຍອດທັງໝົດຂອງ `2.1` ຫຼື `2.1.1`
- `chart_of_account_id` ຕ້ອງເປັນ leaf node ໃນຕາຕະລາງ `chart_of_accounts`

---

## Head of Department Routes (`/head-of-department/*`)

**Middleware:** `auth`, `check.active` (any role assigned as reviewer)

### Budget Review
#### GET /head-of-department/annual-budget
**Description:** List budget plans assigned for review

**Response:** View with user's assigned review tasks

#### GET /head-of-department/annual-budget/{budgetPlan}
**Description:** Review budget plan details

**Access Control:** Only shows if user is assigned as reviewer

**Response:** View with:
- Budget plan details
- Line items (hierarchical)
- Existing comments
- Comment form

#### POST /head-of-department/annual-budget/{budgetPlan}/comment
**Description:** Add comment to budget plan

**Request:**
```php
[
    'comment' => 'required|string',
]
```

**Side Effects:**
- Creates comment with current `submission_round`
- Sends notification to Head of Finance

---

## Deputy Head of Faculty Routes (`/deputy-head-of-faculty/*`)

**Middleware:** `auth`, `check.active`, `role:deputy_head_of_faculty`

### Budget Review & Approval
#### GET /deputy-head-of-faculty/annual-budget
**Description:** List budget plans for review

#### GET /deputy-head-of-faculty/annual-budget/{budgetPlan}
**Description:** Review budget plan details

#### POST /deputy-head-of-faculty/annual-budget/{budgetPlan}/approve
**Description:** Approve budget plan

**Side Effects:**
- Changes status: `PENDING_FINAL_APPROVAL` → `APPROVED`
- Sends notification to Head of Finance

#### POST /deputy-head-of-faculty/annual-budget/{budgetPlan}/reject
**Description:** Reject budget plan with comment

**Request:**
```php
[
    'comment' => 'required|string',
]
```

**Side Effects:**
- Changes status: `PENDING_FINAL_APPROVAL` → `MODIFYING`
- Creates comment
- Sends notification to Head of Finance

---

## Head of Faculty Routes (`/head-of-faculty/*`)

**Middleware:** `auth`, `check.active`, `role:head_of_faculty`

### Dashboard Analytics
#### GET /head-of-faculty/home
**Description:** Dashboard with budget analytics

**Response:** View with:
- Total approved budget
- Total advance requests
- Total actual expenditures
- Remaining budget
- Stacked progress bar
- Pending plans list
- Recent advance requests

### Budget Approval
#### GET /head-of-faculty/annual-budget
**Description:** List budget plans (PENDING_FINAL_APPROVAL or APPROVED)

#### GET /head-of-faculty/annual-budget/{budgetPlan}
**Description:** Review budget plan details

**Access Control:** Only shows PENDING_FINAL_APPROVAL or APPROVED plans

#### POST /head-of-faculty/annual-budget/{budgetPlan}/approve
**Description:** Final approval

**Side Effects:**
- Changes status: `PENDING_FINAL_APPROVAL` → `APPROVED`
- Sends notification to Head of Finance

#### POST /head-of-faculty/annual-budget/{budgetPlan}/reject
**Description:** Reject with comment

**Request:**
```php
[
    'comment' => 'required|string',
]
```

**Side Effects:**
- Changes status: `PENDING_FINAL_APPROVAL` → `MODIFYING`
- Creates comment
- Sends notification to Head of Finance

---

## Accountant Routes (`/accountant/*`)

**Middleware:** `auth`, `check.active`, `role:accountant`

### Home
- `GET /accountant/home` — Dashboard (coming soon)

**Note:** Accountant features not yet implemented

---

## Data Models

### BudgetPlan
```php
{
  "id": int,
  "fiscal_year": int,
  "status": enum("DRAFT", "PENDING_REVIEW", "MODIFYING", "PENDING_FINAL_APPROVAL", "APPROVED"),
  "created_by": int,
  "submission_round": int,
}
```

### BudgetLineItem
```php
{
  "id": int,
  "budget_plan_id": int,
  "account_id": int,
  "amount_regular": decimal(10,2),
  "amount_academic": decimal(10,2),
}
```

### ChartOfAccount
```php
{
  "id": int,
  "account_code": string(8), // "XX-XX-XX-XX"
  "account_name": string,
  "parent_id": int|null,
}
```

### BudgetPlanReviewer
```php
{
  "id": int,
  "budget_plan_id": int,
  "user_id": int,
  "assigned_by": int,
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

### User
```php
{
  "id": int,
  "username": string,
  "full_name": string,
  "password": string(hashed),
  "role_id": int,
  "department_id": int|null,
  "is_active": boolean,
}
```

### DegreeProgram
```php
{
  "id": int,
  "code": string(50), // e.g., "MAP-RE"
  "name": string(255), // e.g., "Master of Applied Physics (Renewable Energy)"
  "level": enum("bachelor", "master", "phd", "masters_phd"),
  "is_active": boolean,
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

### CreditUnitPriceSetting
```php
{
  "id": int,
  "degree_program_id": int, // FK → degree_programs.id
  "credit_unit_price": decimal(15,2), // e.g., 220000.00 (Kip per credit)
  "gov_doc_id": string(255)|null, // e.g., "EDU-2026-001"
  "start_year": int, // ปีที่เริ่มใช้ราคา e.g., 2026
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

### CourseCreditSetting
```php
{
  "id": int,
  "degree_program_id": int, // FK → degree_programs.id
  "course_credit_unit": int, // จำนวนหน่วยกิตของหลักสูตร e.g., 36
  "gov_doc_id": string(255)|null, // e.g., "EDU-2026-002"
  "start_year": int,
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

### PaymentInstallmentSetting
```php
{
  "id": int,
  "degree_program_id": int, // FK → degree_programs.id
  "first_payment_percent": decimal(5,2), // e.g., 60.00
  "second_payment_percent": decimal(5,2), // e.g., 40.00
  "start_year": int,
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

**Constraint:** `first_payment_percent + second_payment_percent = 100`

### RegistrationFeeSetting
```php
{
  "id": int,
  "degree_program_id": int, // FK → degree_programs.id
  "registration_fee_rate": decimal(15,2), // ค่าลงทะเบียนต่อนักศึกษา
  "gov_doc_id": string(255)|null,
  "start_year": int,
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

### AcademicIncomePlan
```php
{
  "id": int,
  "fiscal_year": int,
  "government_doc_id": string|null, // NEW: ເລກທີເອກະສານຈາກລັດຖະບານ
  "plan_start_year": int|null, // NEW: ແຜນເລີ່ມຕົ້ນປີ ທີ
  "status": enum("DRAFT", "APPROVED"),
  "notes": string|null, // NEW: ໝາຍເຫດ
  "created_by": int,
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

### AcademicIncomeItem
```php
{
  "id": int,
  "plan_id": int,
  "section_code": string(3), // "1.1", "1.2", "1.3", "1.4", "3.0", "4.0", "5.0", "6.0"
  "sort_order": int,
  "item_name": string,
  "course_code": string(50)|null, // NEW: ລະຫັດວິຊາ
  "course_name": string(255)|null, // NEW: ຊື່ວິຊາ
  "course_start_year": int|null, // NEW: ປີທີເລີ່ມສອນວິຊາ
  "num_credits": int|null,
  "student_percentage": decimal(5,2)|null, // NEW: % ມຊ - ສ່ວນຮຽນຂອງນັກສຶກສາ
  "rate_per_person": decimal(15,2)|null,
  "num_persons": int,
  "nuol_percentage": decimal(5,4), // 0.1700 = 17%
  "student_year": string|null, // "1", "2", "3", "4", "masters_phd"
  "degree_level": enum("bachelor", "master", "phd", "masters_phd", "all"), // NEW: degree separation
  "department_id": bigint|null, // NEW: link to departments
  "item_type": string(255)|null, // NEW: item categorization
  "registration_fee_rate": decimal(15,2)|null, // NEW: ใช้กับข้อ 1.2 และ 1.4 (ค่าลงทะเบียน)
  "total_income": decimal(18,2)|null, // NEW: ยอดรวมเต็ม (Student × Credit × Price)
  "first_payment_amount": decimal(18,2)|null, // NEW: ยอดชำระรอบแรก (เช่น 60%)
  "second_payment_amount": decimal(18,2)|null, // NEW: ยอดชำระรอบหลัง (เช่น 40%)
  "created_at": timestamp|null,
  "updated_at": timestamp|null,
}
```

**Example: Bachelor Course Item**
```php
{
  "section_code": "1.1",
  "item_name": "ປີ 2 ວິທະຍາສາດຄອມ",
  "course_code": "CS201",
  "course_name": "Computer Science Fundamentals",
  "course_start_year": 2020,
  "degree_level": "bachelor",
  "student_year": "2",
  "num_credits": 37,
  "student_percentage": 100.00,
  "rate_per_person": 50000,
  "num_persons": 60,
  "nuol_percentage": 0.17,
  // Calculation: 60 students × 37 credits × 50,000 = 111,000,000 ກີບ
  // NUOL (17%): 18,870,000 ກີບ
  // Net: 92,130,000 ກີບ
}
```

**Example: Master Course Item**
```php
{
  "section_code": "1.1",
  "item_name": "ປີ 2 ວິທະຍາສາດຄອມ",
  "course_code": "CS201",
  "course_name": "Computer Science Fundamentals",
  "course_start_year": 2020,
  "degree_level": "master",
  "student_year": "2",
  "num_credits": null, // No credits for master
  "student_percentage": 100.00,
  "rate_per_person": 15000000, // Flat rate per person
  "num_persons": 5,
  "nuol_percentage": 0.10,
  // Calculation: 5 students × 15,000,000 = 75,000,000 ກີບ
  // NUOL (10%): 7,500,000 ກີບ
  // Net: 67,500,000 ກີບ
}
```

**Example: Masters+PhD Combined Item**
```php
{
  "section_code": "1.1",
  "item_name": "ປີ 2 ວິທະຍາສາດຄອມ",
  "course_code": "CS201",
  "course_name": "Computer Science Fundamentals",
  "course_start_year": 2020,
  "degree_level": "masters_phd", // Combined masters and PhD
  "student_year": "masters_phd",
  "num_credits": null,
  "student_percentage": 100.00,
  "rate_per_person": 500000, // Combined rate
  "num_persons": 7,
  "nuol_percentage": 0.10,
  // Calculation: 7 students × 500,000 = 3,500,000 ກີບ
  // NUOL (10%): 350,000 ກີບ
  // Net: 3,150,000 ກີບ
}
```

### ExpensePlan
```php
{
  "id": int,
  "fiscal_year": int,
  "status": enum("DRAFT", "APPROVED"),
  "total_amount": decimal(15,2), // ຍອດລວມທັງໝົດຂອງແຜນ
  "created_by": int,
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

### ExpensePlanItem
Each expense item belongs to a hierarchical section (e.g., `2.1`, `2.1.1`) and is linked to a leaf Chart of Account row. The `section_code` is used for grouping (Sum amount) in reports/PDF preview.

```php
{
  "id": int,
  "expense_plan_id": int, // FK → expense_plans.id
  "section_code": string(10), // ເລກອ້າງອີງ ເຊັ່ນ "2.1", "2.1.1"
  "section_name": string(255), // ຊື່ໝວດ ເຊັ່ນ "ແຜນງົບປະມານຄ່າບໍລິຫານສັງລວມ"
  "chart_of_account_id": int|null, // FK → chart_of_accounts.id (ເຊື່ອມກັບ ChartOfAccounts)
  "description": string(255)|null, // ຄຳອະທິບາຍລາຍການ (optional)
  "amount": decimal(15,2), // ຈຳນວນເງິນ
  "sort_order": int, // ລຳດັບການສະແດງຜົນ
  "created_at": timestamp,
  "updated_at": timestamp,
}
```

**Example Structure (Section 2.1 → 2.1.1 → Items):**
```
2.1   ແຜນງົບປະມານລາຍຈ່າຍບໍລິຫານປົກກະຕິຂອງ ຄວທ ປະຈຳສົກປີ 2026
└─ 2.1.1 ແຜນງົບປະມານຄ່າບໍລິຫານສັງລວມ
   ├─ [ChartOfAccount: ຄ່າໄຟຟ້າ]   → 10,000,000 ກີບ
   └─ [ChartOfAccount: ຄ່ານ້ຳປະປາ] →  5,000,000 ກີບ
```

---

## Status Flow Reference

```
DRAFT
  ↓ submit()
PENDING_REVIEW
  ↓ startModifying()
MODIFYING ←┐
  ↑        │
  └────────┘ submit() (loop)
  ↓ submitForFinalApproval()
PENDING_FINAL_APPROVAL
  ├─→ approve() → APPROVED
  └─→ reject() → MODIFYING
```

---

## Validation Rules Reference

### Fiscal Year
- `required|integer|min:2000|max:9999|unique:budget_plans,fiscal_year`

### Amounts
- `nullable|numeric|min:0`

### Account Code
- `required|digits:8|unique:chart_of_accounts`

### Username
- `required|string|unique:users`

### Password
- `required|string|min:8` (on creation)
- `nullable|string|min:8` (on update)

---

## Error Responses

### Validation Errors
**Status:** 302 Redirect with errors

**Session Data:**
```php
[
    'error' => 'ຂໍ້ຄວາມຜິດພາດ...',
    'errors' => [...],
]
```

### Authorization Errors
**Status:** 403 Forbidden

**Response:** `abort(403, 'ບໍ່ພົບບົດບາດຂອງທ່ານ.')`

### Not Found Errors
**Status:** 404 Not Found

---

## Performance Considerations

### N+1 Query Prevention
Use eager loading:
```php
$budgetPlan->load(['lineItems.account', 'lineItems.periodAllocations']);
```

### Common Eager Loads
- BudgetPlan: `lineItems.account`, `lineItems.periodAllocations`, `comments.user.role`, `reviewers.user.role`
- User: `role`, `department`
- ChartOfAccount: `parent`, `children`

### Cache Recommendations
- Department types (cached 1 hour)
- Role lists (rarely changes)
- Chart of accounts tree (cache until updated)

---

## Testing Endpoints

### Using cURL
```bash
# Login
curl -X POST http://localhost:8000/login \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "username=admin&password=password"

# Access protected route (with session cookie)
curl -X GET http://localhost:8000/admin/users \
  -b cookies.txt
```

---

## Degree Level Display System

### View Display Colors
When displaying academic income items, each degree level has a distinct color badge:
- **📘 Bachelor (ປາຍໂທ)**: `bg-blue-100 text-blue-700`
- **🟣 Master (ປັດດິດຕຣີ)**: `bg-purple-100 text-purple-700`
- **🟠 PhD (ປັດດິດທາດນໍາ)**: `bg-orange-100 text-orange-700`
- **🔴 Masters+PhD (ປ.ໂທ+ເອກ)**: `bg-red-100 text-red-700`
- **All**: `bg-gray-100 text-gray-700`

### Degree Label Mapping
```php
$degreeLabel = match($item->degree_level) {
    'bachelor' => 'ປາຍໂທ',
    'master' => 'ປັດດິດຕຣີ',
    'phd' => 'ປັດດິດທາດນໍາ',
    'masters_phd' => 'ປ.ໂທ+ເອກ',
    default => $yearLabels[$item->student_year] ?? $item->student_year
};
```

### Calculation with Student Percentage
When using `student_percentage` field:
```php
// Calculate effective student count
$effectiveStudents = $item->num_persons * ($item->student_percentage / 100);

// Bachelor with credits (37 credits)
if ($item->degree_level === 'bachelor' && $item->num_credits) {
    $totalAmount = $effectiveStudents * $item->num_credits * $ratePerCredit;
}
// Master/PhD with flat rate
elseif ($item->degree_level === 'master' || $item->degree_level === 'phd') {
    $totalAmount = $effectiveStudents * $item->rate_per_person;
}
// Masters+PhD combined
elseif ($item->degree_level === 'masters_phd') {
    $totalAmount = $effectiveStudents * $item->rate_per_person;
}
```

### Academic Income Assessment Calculations (Sections 1.1 – 1.4)

These four formulas drive the Academic Income Assessment summary (ຮ່າງສັງລວມລາຍຮັບວິຊາການ).

#### 1.1 ລາຍຮັບຄ່າໜ່ວຍກິດ ປີ 2–4 (ລະບົບຈ່າຍເງິນ ແລະ ປະລິນຍາໂທ) — Split payment
Inputs: Academic Year, Degree Program, Number of Students
Settings used: `CreditUnitPriceSetting`, `CourseCreditSetting`, `PaymentInstallmentSetting`, University Percentage (ມຊ)

```php
// Total Income = Students × Course Credit Unit × Credit Unit Price
$totalIncome = $studentCount * $courseCreditUnit * $creditUnitPrice;

// First payment (e.g., 60%)
$firstPayment  = $totalIncome * ($firstPaymentPercent  / 100);
// Second payment (e.g., 40%)
$secondPayment = $totalIncome * ($secondPaymentPercent / 100);
```

#### 1.2 ລາຍຮັບຄ່າລົງທະບຽນນັກສຶກສາ ປີ 2–4 ຂອງ ຄວທ
Inputs: Academic Year, Total Number of Students
Settings used: `RegistrationFeeSetting`, University Percentage (ມຊ)

```php
$registrationIncome = $studentCount * $registrationFeeRate;
```

#### 1.3 ລາຍຮັບຄ່າໜ່ວຍກິດ ປີ 1 (ລະບົບຈ່າຍເງິນ) — First payment only
Inputs: Academic Year, Number of Students
Settings used: `CreditUnitPriceSetting`, `CourseCreditSetting`, `PaymentInstallmentSetting`, University Percentage (ມຊ)

```php
$totalIncome  = $studentCount * $courseCreditUnit * $creditUnitPrice;
// ปีที่ 1 เก็บเฉพาะรอบแรก (เช่น 60%)
$firstPayment = $totalIncome * ($firstPaymentPercent / 100);
```

#### 1.4 ຄ່າລົງທະບຽນນັກສຶກສາ ປີ 1 (ລະບົບຈ່າຍເງິນ) ຂອງ ຄວທ
Inputs: Academic Year, Total Number of Students
Settings used: `RegistrationFeeSetting`, University Percentage (ມຊ)

```php
$registrationIncome = $studentCount * $registrationFeeRate;
```

#### Output — ຮ່າງສັງລວມລາຍຮັບວິຊາການ
The system aggregates results of 1.1–1.4 (per Degree Program) into a summary view exposing:
- `total_income` (sum of all sections)
- `first_payment_amount` (rounds 1 of 1.1 + 1.3, plus 1.2 / 1.4 registration income)
- `second_payment_amount` (round 2 of 1.1 only)
- Per-program breakdown for printing/PDF

### Course Information Display
Course details are shown below item names for credit sections:
```
ປີ 2 ວິທະຍາສາດຄອມ
├─ ລະຫັດ: CS201
├─ ວິຊາ: Computer Science Fundamentals
└─ ປີທີເລີ່ມ: 2020
```

### Using Browser DevTools
1. Open Network tab
2. Perform action in browser
3. Inspect request/response
4. Look for AJAX requests (Fetch/XHR)

---

**Last Updated:** 2026-05-13  
**Laravel Version:** 12.0  
**Note:** This is a web application with Blade views, not a REST API. Most endpoints return HTML, not JSON.
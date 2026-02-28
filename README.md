# Laravel Breeze Authentication System

โปรเจคนี้เป็นระบบ Authentication ที่พัฒนาด้วย Laravel Breeze พร้อมการปรับแต่งเฉพาะทางตามความต้องการขององค์กร

## 🎯 ฟีเจอร์หลัก

- ✅ **Login ด้วย Username** - ใช้ username แทน email ในการเข้าสู่ระบบ
- ❌ **ไม่มีระบบ Register** - ปิดการสมัครสมาชิกด้วยตนเอง (เพิ่มผู้ใช้ผ่าน Admin เท่านั้น)
- 🔒 **บังคับ Login ทุกหน้า** - ต้องเข้าสู่ระบบก่อนเข้าใช้งานทุกหน้า
- 👥 **ระบบ Role และ Department** - จัดการสิทธิ์ผู้ใช้ตามบทบาทและแผนก
- ✅ **ตรวจสอบสถานะผู้ใช้** - เช็ค `is_active` ก่อนเข้าใช้งาน

---

## 📋 โครงสร้าง Database

### roles
| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary Key |
| role_name | varchar(50) | ชื่อบทบาท |

### departments
| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary Key |
| department_name | varchar(100) | ชื่อแผนก |
| department_type | varchar(50) | ประเภทแผนก |

### users
| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary Key |
| username | varchar(50) | ชื่อผู้ใช้ (Unique) |
| password | varchar(255) | รหัสผ่าน (Hash) |
| full_name | varchar(100) | ชื่อ-นามสกุล |
| role_id | int | Foreign Key -> roles.id |
| department_id | int | Foreign Key -> departments.id |
| is_active | tinyint | สถานะการใช้งาน (1=active, 0=inactive) |

---

## 🚀 การติดตั้ง

### 1. ติดตั้ง Dependencies

```bash
composer install
npm install
```

### 2. ติดตั้ง Laravel Breeze

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
```

### 3. ตั้งค่า Environment

```bash
cp .env.example .env
php artisan key:generate
```

แก้ไขไฟล์ `.env` ตั้งค่า database:

```env
DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. รัน Migration และ Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 5. Build Assets

```bash
npm run build
# หรือ
npm run dev
```

### 6. รันเซิร์ฟเวอร์

```bash
php artisan serve
```

---

## 🔑 ข้อมูล Login ทดสอบ

| Username | Password | Role | แผนก |
|----------|----------|------|------|
| `admin` | `admin123` | Admin | ฝ่ายบริหาร |
| `finance01` | `password123` | Finance | ฝ่ายการเงิน |

---

## 📁 ไฟล์ที่แก้ไข/สร้างใหม่

### Models
- `app/Models/User.php` - แก้ไขให้รองรับ username และ relationships
- `app/Models/Role.php` - สร้างใหม่
- `app/Models/Department.php` - สร้างใหม่

### Controllers
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php` - เพิ่มเช็ค is_active
- `app/Http/Controllers/Auth/PasswordController.php` - มีอยู่แล้ว (ใช้สำหรับเปลี่ยนรหัสผ่าน)
- `app/Http/Controllers/ProfileController.php` - แก้ไขให้ใช้ full_name

### Requests
- `app/Http/Requests/Auth/LoginRequest.php` - เปลี่ยนจาก email เป็น username
- `app/Http/Requests/ProfileUpdateRequest.php` - แก้ไข validation rules

### Middleware
- `app/Http/Middleware/CheckUserActive.php` - สร้างใหม่สำหรับเช็คสถานะผู้ใช้

### Routes
- `routes/auth.php` - ลบ register routes, เพิ่ม password.update
- `routes/web.php` - บังคับ auth และ check.active middleware

### Views
- `resources/views/auth/login.blade.php` - ใช้ username แทน email
- `resources/views/layouts/navigation.blade.php` - แสดง full_name และ username
- `resources/views/profile/partials/update-profile-information-form.blade.php` - แก้ไขฟอร์ม

### Seeders
- `database/seeders/RoleSeeder.php` - Roles ตัวอย่าง
- `database/seeders/DepartmentSeeder.php` - Departments ตัวอย่าง
- `database/seeders/AdminUserSeeder.php` - Admin user
- `database/seeders/DatabaseSeeder.php` - เรียกใช้ seeders ทั้งหมด

### Bootstrap
- `bootstrap/app.php` - ลงทะเบียน middleware alias

---

## 🔐 Middleware

### check.active
ตรวจสอบว่าผู้ใช้ยังมีสถานะ active อยู่หรือไม่ หากไม่ active จะ logout และ redirect ไปหน้า login พร้อมข้อความแจ้งเตือน

```php
// ใช้ใน routes
Route::middleware(['auth', 'check.active'])->group(function () {
    // routes ที่ต้องการให้ login และ active
});
```

---

## 📝 การเพิ่มผู้ใช้ใหม่

เนื่องจากปิดระบบ Register ผู้ใช้ใหม่ต้องเพิ่มผ่าน Seeder หรือ Tinker:

### วิธีที่ 1: ใช้ Tinker

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'username' => 'newuser',
    'password' => Hash::make('password123'),
    'full_name' => 'ชื่อผู้ใช้ใหม่',
    'role_id' => 3, // Finance
    'department_id' => 2, // ฝ่ายการเงิน
    'is_active' => true,
]);
```

### วิธีที่ 2: สร้าง Seeder ใหม่

```bash
php artisan make:seeder NewUserSeeder
```

แล้วรัน:

```bash
php artisan db:seed --class=NewUserSeeder
```

---

## 🛠️ คำสั่งที่มีประโยชน์

```bash
# ล้าง cache
php artisan optimize:clear

# รัน seeder ใหม่
php artisan db:seed

# รัน seeder เฉพาะ class
php artisan db:seed --class=RoleSeeder

# ดูรายการ routes
php artisan route:list

# ตรวจสอบโครงสร้าง database
php artisan db:show
```

---

## ⚠️ หมายเหตุ

- ระบบนี้ไม่มีการส่ง email (ไม่มี email verification, password reset)
- การเปลี่ยนรหัสผ่านทำได้ที่หน้า Profile เท่านั้น
- ผู้ใช้ที่ไม่ active จะไม่สามารถ login หรือใช้งานระบบได้
- หน้าแรก (`/`) จะ redirect ไปที่หน้า login อัตโนมัติ

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

@extends('layouts.admin')

@section('title', 'ຈັດການງົບປະມານ ສົກ ' . $expensePlan->fiscal_year)
@section('page-title', 'ຈັດການງົບປະມານລາຍຈ່າຍ ສົກ ' . $expensePlan->fiscal_year)

@section('content')

@if(session('success'))
<div class="fns-alert fns-alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="fns-alert fns-alert-danger">{{ session('error') }}</div>
@endif

{{-- Plan header bar --}}
<div style="display:flex;align-items:center;gap:12px;margin-bottom:1.2rem;flex-wrap:wrap;">
    <a href="{{ route('head_of_finance.expense.index') }}" class="fns-btn fns-btn-secondary fns-btn-sm">← ກັບຄືນ</a>
    <span style="font-size:1rem;font-weight:700;color:var(--fns-navy);">ສົກ {{ $expensePlan->fiscal_year }}</span>
    @if($expensePlan->isApproved())
        <span class="fns-badge fns-badge-success" style="font-size:0.8rem;">ອະນຸມັດແລ້ວ</span>
    @else
        <span class="fns-badge fns-badge-warning" style="font-size:0.8rem;">ຮ່າງ</span>
        <form method="POST" action="{{ route('head_of_finance.expense.approve', $expensePlan) }}" style="display:inline;">
            @csrf
            <button type="submit" class="fns-btn fns-btn-success fns-btn-sm"
                onclick="return confirm('ຢືນຢັນການອະນຸມັດ? ຈະບໍ່ສາມາດແກ້ໄຂໄດ້ອີກ.')">ອະນຸມັດ</button>
        </form>
    @endif
    <span style="margin-left:auto;font-size:0.85rem;color:#64748b;">
        ງົບລວມ: <strong>{{ number_format($expensePlan->allCategories->flatMap->items->sum('annual_amount'), 0) }} ກີບ</strong>
    </span>
</div>

{{-- Tree --}}
@include('dashboards.finance_head.expense._tree', [
    'topCategories'  => $expensePlan->topCategories,
    'plan'           => $expensePlan,
    'editable'       => !$expensePlan->isApproved(),
    'chartOfAccounts'=> $chartOfAccounts,
])

{{-- Add main category button --}}
@if(!$expensePlan->isApproved())
<div style="margin-top:1rem;">
    <button class="fns-btn fns-btn-primary" onclick="openCatModal({{ $expensePlan->id }}, null, null)">
        + ເພີ່ມໝວດຫຼັກ
    </button>
</div>
@endif

{{-- ======================= MODALS ======================= --}}

{{-- Add/Edit Category modal --}}
<div id="catModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:10px;padding:1.5rem;width:400px;max-width:95vw;">
        <h3 style="margin:0 0 1rem;font-size:1rem;" id="catModalTitle">ເພີ່ມໝວດ</h3>
        <form method="POST" action="{{ route('head_of_finance.expense-categories.store') }}" id="catForm">
            @csrf
            <input type="hidden" name="plan_id" value="{{ $expensePlan->id }}">
            <input type="hidden" name="parent_id" id="catParentId">

            <div class="fns-form-group">
                <label class="fns-label">ລະຫັດ (ref_code) <span style="color:red">*</span></label>
                <input type="text" name="ref_code" id="catRefCode" class="fns-input" placeholder="ເຊັ່ນ 2.1 ຫຼື 2.1.1" required>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ຊື່ໝວດ <span style="color:red">*</span></label>
                <input type="text" name="name" id="catName" class="fns-input" required>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ລຳດັບ (sort_order)</label>
                <input type="number" name="sort_order" id="catSortOrder" class="fns-input" value="0" min="0">
            </div>
            <div style="display:flex;gap:8px;margin-top:1rem;">
                <button type="submit" class="fns-btn fns-btn-primary">ບັນທຶກ</button>
                <button type="button" class="fns-btn fns-btn-secondary" onclick="closeCatModal()">ຍົກເລີກ</button>
            </div>
        </form>
    </div>
</div>

{{-- Add Item modal --}}
<div id="itemModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:10px;padding:1.5rem;width:540px;max-width:95vw;max-height:90vh;overflow-y:auto;">
        <h3 style="margin:0 0 1rem;font-size:1rem;">ເພີ່ມລາຍການ</h3>
        <form method="POST" action="{{ route('head_of_finance.expense-items.store') }}" id="itemForm">
            @csrf
            <input type="hidden" name="category_id" id="itemCategoryId">

            <div class="fns-form-group">
                <label class="fns-label">ລາຍການ <span style="color:red">*</span></label>
                <input type="text" name="name" id="itemName" class="fns-input" required>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <div class="fns-form-group">
                    <label class="fns-label">ອ້າງອີງ</label>
                    <input type="text" name="reference" id="itemReference" class="fns-input">
                </div>
                <div class="fns-form-group">
                    <label class="fns-label">ໝາຍເຫດ</label>
                    <input type="text" name="remark" id="itemRemark" class="fns-input">
                </div>
                <div class="fns-form-group">
                    <label class="fns-label">ຕໍ່ເດືອນ (ກີບ) <span style="color:red">*</span></label>
                    <input type="number" name="monthly_amount" id="itemMonthly" class="fns-input" min="0" step="0.01" value="0" oninput="calcAnnual()" required>
                </div>
                <div class="fns-form-group">
                    <label class="fns-label">ຈຳນວນ (ຈ/ນ) <span style="color:red">*</span></label>
                    <input type="number" name="quantity" id="itemQty" class="fns-input" min="1" value="12" oninput="calcAnnual()" required>
                </div>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ໝົດປີ (ອັດຕະໂນມັດ)</label>
                <input type="text" id="itemAnnualDisplay" class="fns-input" readonly style="background:#f8fafc;color:#64748b;">
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ແຜນບັນຊີ (COA)</label>
                <select name="chart_of_account_id" id="itemCOA" class="fns-input">
                    <option value="">-- ບໍ່ລະບຸ --</option>
                    @foreach($chartOfAccounts as $coa)
                    <option value="{{ $coa->id }}">{{ $coa->account_code }} — {{ $coa->account_name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display:flex;gap:8px;margin-top:1rem;">
                <button type="submit" class="fns-btn fns-btn-primary">ບັນທຶກ</button>
                <button type="button" class="fns-btn fns-btn-secondary" onclick="closeItemModal()">ຍົກເລີກ</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Item modal --}}
<div id="editItemModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:10px;padding:1.5rem;width:540px;max-width:95vw;max-height:90vh;overflow-y:auto;">
        <h3 style="margin:0 0 1rem;font-size:1rem;">ແກ້ໄຂລາຍການ</h3>
        <form method="POST" id="editItemForm">
            @csrf @method('PATCH')
            <div class="fns-form-group">
                <label class="fns-label">ລາຍການ <span style="color:red">*</span></label>
                <input type="text" name="name" id="editItemName" class="fns-input" required>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <div class="fns-form-group">
                    <label class="fns-label">ອ້າງອີງ</label>
                    <input type="text" name="reference" id="editItemReference" class="fns-input">
                </div>
                <div class="fns-form-group">
                    <label class="fns-label">ໝາຍເຫດ</label>
                    <input type="text" name="remark" id="editItemRemark" class="fns-input">
                </div>
                <div class="fns-form-group">
                    <label class="fns-label">ຕໍ່ເດືອນ (ກີບ) <span style="color:red">*</span></label>
                    <input type="number" name="monthly_amount" id="editItemMonthly" class="fns-input" min="0" step="0.01" oninput="calcEditAnnual()" required>
                </div>
                <div class="fns-form-group">
                    <label class="fns-label">ຈຳນວນ (ຈ/ນ) <span style="color:red">*</span></label>
                    <input type="number" name="quantity" id="editItemQty" class="fns-input" min="1" oninput="calcEditAnnual()" required>
                </div>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ໝົດປີ (ອັດຕະໂນມັດ)</label>
                <input type="text" id="editItemAnnualDisplay" class="fns-input" readonly style="background:#f8fafc;color:#64748b;">
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ແຜນບັນຊີ (COA)</label>
                <select name="chart_of_account_id" id="editItemCOA" class="fns-input">
                    <option value="">-- ບໍ່ລະບຸ --</option>
                    @foreach($chartOfAccounts as $coa)
                    <option value="{{ $coa->id }}">{{ $coa->account_code }} — {{ $coa->account_name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display:flex;gap:8px;margin-top:1rem;">
                <button type="submit" class="fns-btn fns-btn-primary">ບັນທຶກ</button>
                <button type="button" class="fns-btn fns-btn-secondary" onclick="closeEditItemModal()">ຍົກເລີກ</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCatModal(planId, parentId, parentRef) {
    document.getElementById('catParentId').value = parentId ?? '';
    document.getElementById('catRefCode').value = parentRef ? parentRef + '.' : '';
    document.getElementById('catName').value = '';
    document.getElementById('catModalTitle').textContent = parentId ? 'ເພີ່ມໝວດຍ່ອຍ' : 'ເພີ່ມໝວດຫຼັກ';
    document.getElementById('catModal').style.display = 'flex';
}
function closeCatModal() { document.getElementById('catModal').style.display = 'none'; }

function openItemModal(categoryId) {
    document.getElementById('itemCategoryId').value = categoryId;
    document.getElementById('itemName').value = '';
    document.getElementById('itemReference').value = '';
    document.getElementById('itemMonthly').value = 0;
    document.getElementById('itemQty').value = 12;
    document.getElementById('itemRemark').value = '';
    document.getElementById('itemCOA').value = '';
    calcAnnual();
    document.getElementById('itemModal').style.display = 'flex';
}
function closeItemModal() { document.getElementById('itemModal').style.display = 'none'; }

function calcAnnual() {
    var m = parseFloat(document.getElementById('itemMonthly').value) || 0;
    var q = parseInt(document.getElementById('itemQty').value) || 0;
    document.getElementById('itemAnnualDisplay').value = (m * q).toLocaleString('en-US', {maximumFractionDigits:0}) + ' ກີບ';
}
calcAnnual();

function openEditItemModal(item) {
    document.getElementById('editItemForm').action = '/head-of-finance/expense-items/' + item.id;
    document.getElementById('editItemName').value = item.name;
    document.getElementById('editItemReference').value = item.reference ?? '';
    document.getElementById('editItemMonthly').value = item.monthly_amount;
    document.getElementById('editItemQty').value = item.quantity;
    document.getElementById('editItemRemark').value = item.remark ?? '';
    document.getElementById('editItemCOA').value = item.chart_of_account_id ?? '';
    calcEditAnnual();
    document.getElementById('editItemModal').style.display = 'flex';
}
function closeEditItemModal() { document.getElementById('editItemModal').style.display = 'none'; }

function calcEditAnnual() {
    var m = parseFloat(document.getElementById('editItemMonthly').value) || 0;
    var q = parseInt(document.getElementById('editItemQty').value) || 0;
    document.getElementById('editItemAnnualDisplay').value = (m * q).toLocaleString('en-US', {maximumFractionDigits:0}) + ' ກີບ';
}
</script>

@endsection

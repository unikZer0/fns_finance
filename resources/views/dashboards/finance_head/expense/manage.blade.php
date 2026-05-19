@extends('layouts.admin')

@section('title', 'ຈັດການງົບປະມານ ສົກ ' . $expensePlan->fiscal_year)
@section('page-title', 'ຈັດປະເມີນລາຍຈ່າຍ ສົກ ' . $expensePlan->fiscal_year)

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
    <span style="margin-left:auto;font-size:0.85rem;color:#64748b;">
        ງົບລວມ: <strong>{{ number_format($expensePlan->allCategories->flatMap->items->sum('annual_amount'), 0) }} ກີບ</strong>
    </span>
</div>

{{-- Tree --}}
@include('dashboards.finance_head.expense._tree', [
    'topCategories'  => $expensePlan->topCategories,
    'plan'           => $expensePlan,
    'editable'       => true,
    'chartOfAccounts'=> $chartOfAccounts,
])

{{-- Add main category button --}}
<div style="margin-top:1rem;">
    <button class="fns-btn fns-btn-primary" onclick="openCatModal({{ $expensePlan->id }}, null, null)">
        + ເພີ່ມໝວດຫຼັກ
    </button>
</div>

{{-- ======================= MODALS ======================= --}}

{{-- Edit Category modal --}}
<div id="editCatModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:10px;padding:1.5rem;width:480px;max-width:95vw;max-height:90vh;overflow-y:auto;">
        <h3 style="margin:0 0 1rem;font-size:1rem;">ແກ້ໄຂໝວດ</h3>
        <form method="POST" id="editCatForm">
            @csrf @method('PATCH')
            <div class="fns-form-group">
                <label class="fns-label">ລະຫັດ (ref_code) <span style="color:red">*</span></label>
                <input type="text" name="ref_code" id="editCatRefCode" class="fns-input" required>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ຊື່ໝວດ <span style="color:red">*</span></label>
                <input type="text" name="name" id="editCatName" class="fns-input" required>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ລຳດັບ (sort_order)</label>
                <input type="number" name="sort_order" id="editCatSortOrder" class="fns-input" min="0">
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ຮູບແບບ Formula</label>
                <select name="formula_type" id="editCatFormulaType" class="fns-input">
                    <option value="AB">AB — 2 ປັດໄຈ (col_a × col_b)</option>
                    <option value="ABC">ABC — 3 ປັດໄຈ (col_a × col_b × col_c)</option>
                </select>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ຊື່ Column (ເວັ້ນວ່າງ = ໃຊ້ default)</label>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:6px;">
                    <input type="text" name="col_a_label" id="editCatColA" class="fns-input" placeholder="ຕໍ່ເດືອນ (ກີບ)">
                    <input type="text" name="col_b_label" id="editCatColB" class="fns-input" placeholder="ຈ/ນ">
                    <input type="text" name="col_c_label" id="editCatColC" class="fns-input" placeholder="ຄັ້ງ">
                </div>
                <p style="font-size:0.72rem;color:#94a3b8;margin:4px 0 0;">Col A &nbsp;|&nbsp; Col B &nbsp;|&nbsp; Col C (ABC ເທົ່ານັ້ນ)</p>
            </div>
            <div style="display:flex;gap:8px;margin-top:1rem;">
                <button type="submit" class="fns-btn fns-btn-primary">ບັນທຶກ</button>
                <button type="button" class="fns-btn fns-btn-secondary" onclick="closeEditCatModal()">ຍົກເລີກ</button>
            </div>
        </form>
    </div>
</div>

{{-- Add Category modal --}}
<div id="catModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:10px;padding:1.5rem;width:480px;max-width:95vw;max-height:90vh;overflow-y:auto;">
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
            <div class="fns-form-group">
                <label class="fns-label">ຮູບແບບ Formula</label>
                <select name="formula_type" id="catFormulaType" class="fns-input">
                    <option value="AB">AB — 2 ປັດໄຈ (col_a × col_b)</option>
                    <option value="ABC">ABC — 3 ປັດໄຈ (col_a × col_b × col_c)</option>
                </select>
            </div>
            <div class="fns-form-group">
                <label class="fns-label">ຊື່ Column (ເວັ້ນວ່າງ = ໃຊ້ default)</label>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:6px;">
                    <input type="text" name="col_a_label" class="fns-input" placeholder="ຕໍ່ເດືອນ (ກີບ)">
                    <input type="text" name="col_b_label" class="fns-input" placeholder="ຈ/ນ">
                    <input type="text" name="col_c_label" class="fns-input" placeholder="ຄັ້ງ">
                </div>
                <p style="font-size:0.72rem;color:#94a3b8;margin:4px 0 0;">Col A &nbsp;|&nbsp; Col B &nbsp;|&nbsp; Col C (ABC ເທົ່ານັ້ນ)</p>
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
                    <label class="fns-label" id="itemLabelA">ຕໍ່ເດືອນ (ກີບ) <span style="color:red">*</span></label>
                    <input type="number" name="monthly_amount" id="itemMonthly" class="fns-input" min="0" step="0.01" value="0" oninput="calcAnnual()" required>
                </div>
                <div class="fns-form-group">
                    <label class="fns-label" id="itemLabelB">ຈ/ນ <span style="color:red">*</span></label>
                    <input type="number" name="quantity" id="itemQty" class="fns-input" min="0" value="12" oninput="calcAnnual()" required>
                </div>
            </div>
            <div class="fns-form-group" id="itemQtyCWrap" style="display:none;">
                <label class="fns-label" id="itemLabelC">ຄັ້ງ <span style="color:red">*</span></label>
                <input type="number" name="qty_c" id="itemQtyC" class="fns-input" min="0" step="0.01" value="1" oninput="calcAnnual()">
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
                    <label class="fns-label" id="editItemLabelA">ຕໍ່ເດືອນ (ກີບ) <span style="color:red">*</span></label>
                    <input type="number" name="monthly_amount" id="editItemMonthly" class="fns-input" min="0" step="0.01" oninput="calcEditAnnual()" required>
                </div>
                <div class="fns-form-group">
                    <label class="fns-label" id="editItemLabelB">ຈ/ນ <span style="color:red">*</span></label>
                    <input type="number" name="quantity" id="editItemQty" class="fns-input" min="0" oninput="calcEditAnnual()" required>
                </div>
            </div>
            <div class="fns-form-group" id="editItemQtyCWrap" style="display:none;">
                <label class="fns-label" id="editItemLabelC">ຄັ້ງ <span style="color:red">*</span></label>
                <input type="number" name="qty_c" id="editItemQtyC" class="fns-input" min="0" step="0.01" oninput="calcEditAnnual()">
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
// ===== Category modals =====
function openCatModal(planId, parentId, parentRef) {
    document.getElementById('catParentId').value = parentId ?? '';
    document.getElementById('catRefCode').value = parentRef ? parentRef + '.' : '';
    document.getElementById('catName').value = '';
    document.getElementById('catModalTitle').textContent = parentId ? 'ເພີ່ມໝວດຍ່ອຍ' : 'ເພີ່ມໝວດຫຼັກ';
    document.getElementById('catModal').style.display = 'flex';
}
function closeCatModal() { document.getElementById('catModal').style.display = 'none'; }

function openEditCatModal(id, refCode, name, sortOrder, formulaType, colA, colB, colC) {
    document.getElementById('editCatForm').action = '/head-of-finance/expense-categories/' + id;
    document.getElementById('editCatRefCode').value = refCode;
    document.getElementById('editCatName').value = name;
    document.getElementById('editCatSortOrder').value = sortOrder;
    document.getElementById('editCatFormulaType').value = formulaType || 'AB';
    document.getElementById('editCatColA').value = colA || '';
    document.getElementById('editCatColB').value = colB || '';
    document.getElementById('editCatColC').value = colC || '';
    document.getElementById('editCatModal').style.display = 'flex';
}
function closeEditCatModal() { document.getElementById('editCatModal').style.display = 'none'; }

// ===== Item modals =====
function openItemModal(categoryId, formulaType, labelA, labelB, labelC) {
    var isABC = formulaType === 'ABC';
    document.getElementById('itemCategoryId').value = categoryId;
    document.getElementById('itemName').value = '';
    document.getElementById('itemReference').value = '';
    document.getElementById('itemMonthly').value = 0;
    document.getElementById('itemQty').value = isABC ? 1 : 12;
    document.getElementById('itemQtyC').value = 1;
    document.getElementById('itemRemark').value = '';
    document.getElementById('itemCOA').value = '';
    document.getElementById('itemLabelA').innerHTML = (labelA || 'ຕໍ່ເດືອນ (ກີບ)') + ' <span style="color:red">*</span>';
    document.getElementById('itemLabelB').innerHTML = (labelB || 'ຈ/ນ') + ' <span style="color:red">*</span>';
    document.getElementById('itemLabelC').innerHTML = (labelC || 'ຄັ້ງ') + ' <span style="color:red">*</span>';
    document.getElementById('itemQtyCWrap').style.display = isABC ? '' : 'none';
    calcAnnual();
    document.getElementById('itemModal').style.display = 'flex';
}
function closeItemModal() { document.getElementById('itemModal').style.display = 'none'; }

function calcAnnual() {
    var a = parseFloat(document.getElementById('itemMonthly').value) || 0;
    var b = parseFloat(document.getElementById('itemQty').value) || 0;
    var cWrap = document.getElementById('itemQtyCWrap');
    var c = (cWrap.style.display !== 'none') ? (parseFloat(document.getElementById('itemQtyC').value) || 1) : 1;
    document.getElementById('itemAnnualDisplay').value = (a * b * c).toLocaleString('en-US', {maximumFractionDigits:0}) + ' ກີບ';
}
calcAnnual();

function openEditItemModal(btn) {
    var item = JSON.parse(btn.dataset.item);
    var formulaType = btn.dataset.formula;
    var labelA = btn.dataset.labelA;
    var labelB = btn.dataset.labelB;
    var labelC = btn.dataset.labelC;
    var isABC = formulaType === 'ABC';
    document.getElementById('editItemForm').action = '/head-of-finance/expense-items/' + item.id;
    document.getElementById('editItemName').value = item.name;
    document.getElementById('editItemReference').value = item.reference ?? '';
    document.getElementById('editItemMonthly').value = item.monthly_amount;
    document.getElementById('editItemQty').value = item.quantity;
    document.getElementById('editItemQtyC').value = item.qty_c ?? 1;
    document.getElementById('editItemRemark').value = item.remark ?? '';
    document.getElementById('editItemCOA').value = item.chart_of_account_id ?? '';
    document.getElementById('editItemLabelA').innerHTML = (labelA || 'ຕໍ່ເດືອນ (ກີບ)') + ' <span style="color:red">*</span>';
    document.getElementById('editItemLabelB').innerHTML = (labelB || 'ຈ/ນ') + ' <span style="color:red">*</span>';
    document.getElementById('editItemLabelC').innerHTML = (labelC || 'ຄັ້ງ') + ' <span style="color:red">*</span>';
    document.getElementById('editItemQtyCWrap').style.display = isABC ? '' : 'none';
    calcEditAnnual();
    document.getElementById('editItemModal').style.display = 'flex';
}
function closeEditItemModal() { document.getElementById('editItemModal').style.display = 'none'; }

function calcEditAnnual() {
    var a = parseFloat(document.getElementById('editItemMonthly').value) || 0;
    var b = parseFloat(document.getElementById('editItemQty').value) || 0;
    var cWrap = document.getElementById('editItemQtyCWrap');
    var c = (cWrap.style.display !== 'none') ? (parseFloat(document.getElementById('editItemQtyC').value) || 1) : 1;
    document.getElementById('editItemAnnualDisplay').value = (a * b * c).toLocaleString('en-US', {maximumFractionDigits:0}) + ' ກີບ';
}
</script>

@endsection

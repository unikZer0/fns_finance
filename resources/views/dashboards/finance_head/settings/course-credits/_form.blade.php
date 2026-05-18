<div class="fns-form-group">
    <label class="fns-label">ສາຂາວິຊາ <span style="color:red;">*</span></label>
    <select name="degree_program_id" id="degree_program_id"
        class="fns-input @error('degree_program_id') fns-input-error @enderror" required>
        <option value="">-- ເລືອກສາຂາວິຊາ --</option>
        @foreach($programs as $p)
            <option value="{{ $p->id }}"
                data-level="{{ $p->level }}"
                @selected(old('degree_program_id', $setting->degree_program_id ?? '') == $p->id)>
                [{{ $p->level_label }}{{ $p->study_year ? ' ປີ '.$p->study_year : '' }}] {{ $p->name }}
            </option>
        @endforeach
    </select>
    @error('degree_program_id')<p class="fns-error">{{ $message }}</p>@enderror
</div>

{{-- Total helper — only meaningful for master/phd (60/40 split) --}}
<div id="total-helper" style="display:none; background:#f0f9ff; border:1px solid #bae6fd; border-radius:8px; padding:1rem; margin-bottom:1rem;">
    <label class="fns-label" style="color:#0369a1;">
        ໜ່ວຍກິດລວມທັງໝົດ (ອັດຕາ 60 : 40)
        <span style="font-weight:400; font-size:0.78rem; color:#64748b;">
            — ປ້ອນຈຳນວນລວມ ລະບົບຈະຄຳນວນ ປີ 1 (60%) ແລະ ປີ 2+ (40%) ໃຫ້
        </span>
    </label>
    <input type="number" id="total_units" min="1" max="9999" step="0.5"
        placeholder="ເຊັ່ນ: 240"
        class="fns-input" style="max-width:200px;">
    <div id="split-preview" style="margin-top:0.5rem; font-size:0.82rem; color:#0369a1; display:none;">
        ປີ 1 (60%) = <strong id="preview-yr1">—</strong> ໜ່ວຍ &nbsp;|&nbsp;
        ປີ 2+ (40%) = <strong id="preview-yr2">—</strong> ໜ່ວຍ
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
    <div class="fns-form-group" style="margin-bottom:0;">
        <label class="fns-label">
            ໜ່ວຍກິດ ປີ 2+ <span style="color:red;">*</span>
            <span style="font-weight:400; font-size:0.78rem; color:#64748b;" id="yr2-hint"></span>
        </label>
        <input type="number" name="course_credit_unit" id="course_credit_unit"
            min="1" max="999" step="0.5"
            value="{{ old('course_credit_unit', $setting->course_credit_unit ?? '') }}"
            class="fns-input @error('course_credit_unit') fns-input-error @enderror" required>
        @error('course_credit_unit')<p class="fns-error">{{ $message }}</p>@enderror
    </div>

    <div class="fns-form-group" id="yr1-field" style="margin-bottom:0; display:none;">
        <label class="fns-label">
            ໜ່ວຍກິດ ປີ 1 (60%)
            <span style="font-weight:400; font-size:0.78rem; color:#64748b;">ສຳລັບ ປ.ໂທ/ເອກ</span>
        </label>
        <input type="number" name="year1_credit_unit" id="year1_credit_unit"
            min="0" max="999" step="0.5"
            value="{{ old('year1_credit_unit', $setting->year1_credit_unit ?? '') }}"
            class="fns-input @error('year1_credit_unit') fns-input-error @enderror">
        @error('year1_credit_unit')<p class="fns-error">{{ $message }}</p>@enderror
    </div>
</div>

<div class="fns-form-group" style="margin-top:1rem;">
    <label class="fns-label">ເລກທີເອກະສານອ້າງອີງ (ລັດຖະບານ)</label>
    <input type="text" name="gov_doc_id" value="{{ old('gov_doc_id', $setting->gov_doc_id ?? '') }}" class="fns-input">
</div>

<div class="fns-form-group">
    <label class="fns-label">ປີທີ່ເລີ່ມໃຊ້ <span style="color:red;">*</span></label>
    <input type="number" name="start_year" min="2000" max="2100"
        value="{{ old('start_year', $setting->start_year ?? date('Y')) }}"
        class="fns-input @error('start_year') fns-input-error @enderror" required>
    @error('start_year')<p class="fns-error">{{ $message }}</p>@enderror
</div>

<script>
(function () {
    const select   = document.getElementById('degree_program_id');
    const helper   = document.getElementById('total-helper');
    const yr1Field = document.getElementById('yr1-field');
    const totalIn  = document.getElementById('total_units');
    const yr1In    = document.getElementById('year1_credit_unit');
    const yr2In    = document.getElementById('course_credit_unit');
    const preview  = document.getElementById('split-preview');
    const pvYr1    = document.getElementById('preview-yr1');
    const pvYr2    = document.getElementById('preview-yr2');

    function isMasterPhd() {
        const opt = select.options[select.selectedIndex];
        return opt && ['master','phd'].includes(opt.dataset.level);
    }

    function toggleFields() {
        const mp = isMasterPhd();
        helper.style.display   = mp ? '' : 'none';
        yr1Field.style.display = mp ? '' : 'none';
        if (!mp) {
            yr1In.value = '';
            totalIn.value = '';
            preview.style.display = 'none';
        }
    }

    function applyTotal() {
        const total = parseFloat(totalIn.value);
        if (!total || total <= 0) { preview.style.display = 'none'; return; }
        const yr1 = Math.round(total * 0.6 * 10) / 10;   // 60%
        const yr2 = Math.round(total * 0.4 * 10) / 10;   // 40%
        yr1In.value = yr1;
        yr2In.value = yr2;
        pvYr1.textContent = yr1;
        pvYr2.textContent = yr2;
        preview.style.display = '';
    }

    select.addEventListener('change', toggleFields);
    totalIn.addEventListener('input', applyTotal);

    // Init on page load (edit form already has value selected)
    toggleFields();
})();
</script>

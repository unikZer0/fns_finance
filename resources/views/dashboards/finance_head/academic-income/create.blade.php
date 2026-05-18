@extends('layouts.admin')

@section('title', 'ສ້າງແຜນລາຍຮັບ')
@section('page-title', 'ສ້າງແຜນລາຍຮັບວິຊາການ')

@section('content')
<div class="fns-card" style="max-width:520px;">
    <form method="POST" action="{{ route('head_of_finance.academic-income.store') }}">
        @csrf

        <div class="fns-form-group">
            <label class="fns-label">ສົກປີງົບປະມານ <span style="color:red;">*</span></label>
            <input type="number" name="fiscal_year" min="2000" max="2100"
                value="{{ old('fiscal_year', date('Y')) }}"
                class="fns-input @error('fiscal_year') fns-input-error @enderror" required>
            @error('fiscal_year')<p class="fns-error">{{ $message }}</p>@enderror
        </div>

        <div class="fns-form-group">
            <label class="fns-label">ໝາຍເຫດ</label>
            <textarea name="notes" rows="3" class="fns-input">{{ old('notes') }}</textarea>
        </div>

        <div style="display:flex; gap:0.5rem; margin-top:1.5rem;">
            <button type="submit" class="fns-btn fns-btn-primary">ສ້າງແຜນ</button>
            <a href="{{ route('head_of_finance.academic-income.index') }}" class="fns-btn fns-btn-secondary">ຍົກເລີກ</a>
        </div>
    </form>
</div>
@endsection

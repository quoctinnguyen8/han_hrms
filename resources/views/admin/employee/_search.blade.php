@php
    // nhận giá trị truyền vào
    $formId = $formId ?? 'search-form';

    $isSearching = request()->filled('employee_code') ||
                   request()->filled('full_name') ||
                   request()->filled('department_code');

@endphp

<form method="get" class="collapse {{ $isSearching ? 'show' : '' }}" id="{{ $formId }}">
    <h3>Tìm kiếm nhân viên</h3>
    <div class="row">
        <div class="col-md-4">
            <x-input name="employee_code" label="Mã nhân viên" placeholder="Tìm chính xác theo mã NV" value="{{ request('employee_code') }}" />
        </div>
        <div class="col-md-4">
            <x-input name="full_name" label="Tên nhân viên" value="{{ request('full_name') }}" />
        </div>
        <div class="col-md-4">
            <x-select name="department_code" label="Phòng ban" model="Department"
                valueField="department_code" textField="department_name" selected="{{ request('department_code') }}" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
            <button type="reset" class="btn btn-outline-dark">Reset</button>
        </div>
    </div>
</form>

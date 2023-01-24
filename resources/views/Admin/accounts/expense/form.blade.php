@extends('Admin.layouts.app')

@php
    if (isset($expense->id)){
        $route = route($controllerInfo->routeNamePrefix . '.update', $expense->id);
    } else {
        $route = route($controllerInfo->routeNamePrefix . '.store');
        $expense = new \App\Expense();
    }
@endphp

@section('page_title', $controllerInfo->title)
@if(isset($expense->id))
    @section('page_tagline', 'Update '.$controllerInfo->title)
@else
    @section('page_tagline', 'Create '.$controllerInfo->title)
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($expense->id)) Update @else Create @endif {{ $controllerInfo->title }}
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="group-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($expense->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="expense_title" class="col-2 col-form-label">
                        Expense Title *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="expense_title" name="expense_title"
                               value="{{ old('expense_title', $expense->expense_title) }}" placeholder="Expense Title" required>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="expense_by" class="col-2 col-form-label">
                        Expense By *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="expense_by" name="expense_by"
                               value="{{ old('expense_by', $expense->expense_by) }}" placeholder="Full Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expense_category_id" class="col-2 col-form-label">
                        Expense Category *
                    </label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker"
                                name="expense_category_id" id="expense_category_id">
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('expense_category_id', $expense->expense_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expense_date" class="col-2 col-form-label">Date Of Expense *</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="expense_date" name="expense_date"
                               value="{{ \Carbon\Carbon::parse(old('expense_date', $expense->expense_date))->format('d-m-Y') }}" placeholder="Date Of Expense" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-2 col-form-label">Amount *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="amount" name="amount"
                               value="{{ old('amount', $expense->amount) }}" placeholder="1000.00" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-2 col-form-label">
                        Description
                    </label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" id="description"
                                  name="description"
                                  rows="5"
                                  placeholder="Description">{{ old('description', $expense->description) }}</textarea>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ route($controllerInfo->routeNamePrefix . '.index') }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#accounts-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#expense-list-sm').addClass('kt-menu__item--active');
        });
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/accounts/expense.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush

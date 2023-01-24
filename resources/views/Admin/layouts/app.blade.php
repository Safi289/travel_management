@extends('dashboard::layouts.app')

@push('custom-menus')
    @if(super_user() && developer_mode())
        <li class="kt-menu__section ">
            <h4 class="kt-menu__section-text">Application Settings</h4>
            <i class="kt-menu__section-icon flaticon-more-v2"></i>
        </li>
        <li id="passport-status-mm" class="kt-menu__item" aria-haspopup="true">
            <a href="{{ route('passport-status.index') }}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-address-card"></i><span class="kt-menu__link-text">Passport Status</span></a>
        </li>
    @endif
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.kt-datepicker').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd-mm-yyyy',
                autoclose: true
            });
            $('.kt_datetimepicker').datetimepicker({
                todayHighlight: true,
                inline: true,
                sideBySide: true,
                orientation: "bottom left",
                locale: 'de',
                format: 'dd-mm-yyyy hh:ii:ss',
                autoclose: true
            });
            $('.kt-selectpicker').selectpicker();
        });
    </script>
@endpush

<script>
    $(document).ready(function () {
        $('#Customer-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
        $('#add-new-customer-sm').addClass('kt-menu__item--active');

        $('#document_table_section').on('click', '.delete-button', function () {
            let id = $(this).attr('data-id');
            $('#modal-delete-button').unbind().click(function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: "{{ url('json/delete-attached-document') }}/" + id,
                    type: 'POST',
                    dataType: 'json',
                    data: {},
                    success: function (response) {
                        if (response.success) {
                            $('#tr-' + id).fadeOut();
                            toastr.success(response.message);
                        } else {
                            toastr.error("Whoops! Something Went Wrong!")
                        }
                    }
                }).done(function () {

                });
            });
        });
    });

    var customer_type = parseInt("{{ old('type', $customer->type) == null ? 1 : old('type', $customer->type) }}");
    var customer_identity_type = parseInt("{{ old('identity', $customer->identity) == null ? 1 : old('identity', $customer->identity) }}");
    var customer_gender = parseInt("{{ old('gender', $customer->gender) == null ? 1 : old('gender', $customer->gender) }}");

    var current_district = parseInt("{{ old('current_district', $customer->current_district) }}");
    var current_police_station = parseInt("{{ old('current_police_station', $customer->current_police_station) }}");

    var permanent_district = parseInt("{{ old('permanent_district', $customer->permanent_district) }}");
    var permanent_police_station = parseInt("{{ old('permanent_police_station', $customer->permanent_police_station) }}");
    var group_id = parseInt("{{ old('group_id', $customer->group_id) }}");
    var maharam_id = parseInt("{{ old('maharam_id', $customer->maharam_id) }}");
    var dependent_id = parseInt("{{ old('dependent_id', $customer->dependent_id) }}");
    var customer_mobile = "{{ old('mobile', $customer->mobile) }}";
</script>

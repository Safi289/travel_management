<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '.delete-button', function () {
            let id = $(this).attr('data-id');
            $('#modal-delete-button').unbind().click(function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: "{{ route('passport-collection.index') }}/" + id,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {},
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $('#passport-' + id).remove().fadeOut();
                        } else {
                            toastr.error("Whoops! Something Went Wrong!")
                        }
                    }
                }).done(function () {

                });
            });
        });
    });
</script>

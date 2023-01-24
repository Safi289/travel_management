let vm = new Vue({
    el: "#passport_page",
    data: {
        documentToDelete: null
    },
    mounted() {
        this.jquery();
    },
    methods: {
        jquery() {
            $('body').on('click', '.document-delete-button', (event) => {
                event.preventDefault();
                event.target.parentNode.parentNode.parentNode.remove();
            });
            $('body').on('click', '#modal-delete-button', (event) => {
                axios.post('/passport-info/delete-document/' + this.documentToDelete)
                    .then((response) => {
                        if (response.data.success) {
                            $("tr[row-id='" + this.documentToDelete + "']").fadeTo(1000, 0.01, function(){
                                $(this).slideUp(150, function() {
                                    $(this).remove();
                                });
                            });
                        }
                    });
            });
        },
        addNewDocument() {
            let html = `
            <div class="row mt-3">
                <div class="col-5">
                    <input class="form-control" type="file" id="document[]" name="document[]">
                </div>
                <div class="col-5">
                    <input class="form-control" type="text" id="document_title[]" name="document_title[]" placeholder="Document Title">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger document-delete-button"><i class="flaticon-delete"></i></button>
                </div>
            </div>
            `;
            let el = document.createElement('div');
            el.innerHTML = html;
            document.getElementById("document_upload_div").appendChild(el);
        },
        deleteDocument(id) {
            this.documentToDelete = id
            $('#delete-modal').modal();
        }
    }
});

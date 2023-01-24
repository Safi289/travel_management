<!--begin: Form Wizard Step 4-->
<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
    @if ($customer->documents)
        <div class="row" id="document_table_section">
            <div class="col-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <td width="80%">Document Title</td>
                        <td width="20%">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customer->documents as $document)
                        <tr id="tr-{{ $document->id }}">
                            <td>{{ $document->title }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $document->id }}">
                                    <i class="flaticon-delete"></i> Detach Document
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <section id="document-upload">
        <div class="row">
            <div class="col-5">
                <div class="form-group row">
                    <label class="col-3 col-form-label text-right">File</label>
                    <div class="col-9 custom-file">
                        <input type="file" class="form-control" name="document[]">
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group row">
                    <label for="document_title[]" class="col-3 col-form-label text-right">Document Title</label>
                    <div class="col-9">
                        <input class="form-control" type="text" name="document_title[]" placeholder="Document Title">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-danger document-delete-button"><i class="flaticon-delete"></i></button>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6 text-right">
            <button type="button" class="btn btn-success text-right" @click.prevent="addNewDocument">Add New Document</button>
        </div>
    </div>
</div>
<!--end: Form Wizard Step 4-->

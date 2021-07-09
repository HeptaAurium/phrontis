<div class="modal fade" id="importStudentModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Students from CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/students" method="post" enctype="multipart/form-data" class="rounded p-2 ">
                    @csrf
                    <div class="form-group text-center">
                        <label class="custom-file">
                            <input type="file" name="file" id="" placeholder="" class="custom-file-input"
                                aria-describedby="fileHelpId">
                            <span class="custom-file-control"><i class="fa fa-upload" aria-hidden="true"></i> Upload CSV File</span>
                        </label>
                    </div>
                    <hr style="margin:10px auto;border-top:1px solid #ddd;">
                    <button type="submit" class="btn btn-success px-4 text-center"> <i class="fas fa-upload    "></i> Upload</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createStreamModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Stream</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/streams" method="post" id="formCreateStream">
                    @csrf
                    <div class="form-group">
                      <label for="name">Stream Name</label>
                      <input type="text" name="name" id="stream_name" pattern="[A-Za-z]+" title="Only alphabet characters are accepted" class="form-control" placeholder="Please provide Stream Name (alphabets only)" required>


                     <small class="text-danger pl-3" style="transition: .6s" id="error_stream_name"></small>
                    </div>
                    <button type="submit" class="btn btn-success btn-md px-5 submit-btn" id="submitStream">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
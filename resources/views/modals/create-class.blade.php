<div class="modal fade" id="createClassModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/classes" method="post" id="formCreateClass">
                    @csrf
                    <div class="form-group">
                        <label for="name">Class Name</label>
                        <input type="text" name="name" id="class_name" class="form-control"
                            placeholder="Enter Class Name" aria-describedby="stream_name_error" required>
                        <small class="text-danger pl-3" style="transition: .6s" id="error_class_name"
                            class="text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="streams">Streams in the Class</label>
                        <select class="custom-select form-control" multiple name="streams[]" id="streams_in_class">
                            @foreach (\App\Models\Stream::get() as $item)
                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" id="submitClass" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

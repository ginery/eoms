<div class="modal fade" id="updateFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="update-folder-document-form">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" placeholder="User id" id="document-id">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Folder Name<span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="document_name" placeholder="Folder Name" id="document-name">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" > 
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Description</label>
                                <input type="text"  class="form-control" name="description" placeholder="Folder Description" id="document-description"> 
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" > 
                            </div> --}}
                        </div>
                        {{-- <div class="row">
                            <div class="form-group col-md-6">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number <span class="text-danger">*</span></label>
                                <input type="number" name="phone_number" class="form-control" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Select Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-control" id="exampleSelect1">
                                <option value="0">Staff/Faculty</option>
                                <option value="1">Administrator</option>                       
                            </select>
                        </div> --}}
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="createProposal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="user_id" placeholder="User id" value="{{ Auth::user()->id }}">                  
                    <div class="form-group col-12">
                        <label>Program Name<span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" name="program_name" placeholder="Program Name">
                    </div>
                    <div class="container mt-5">                      
                         <input type="file" name="filepond" id="filepond" multiple>                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
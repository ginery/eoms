<div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="create-folder-document-form">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="user_id" placeholder="User id" value="{{ Auth::user()->id }}">
                    <input type="hidden" class="form-control" id="folder_id" name="folder_id" value="0">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Project Name<span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="document_name" placeholder="Folder Name">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" > 
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Description</label>
                                <input type="text"  class="form-control" name="description" placeholder="Folder Description">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" > 
                            </div> --}}
                        </div>
                        {{-- <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-sm-12">Project Leader</label>
                                <div class="col-md-12">
                                    <select class="form-control select2" id="kt_select2_3" name="assigned_leader" style="width: 100% !important;">
                                        <option>No User Selected</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-sm-12">Project Members</label>
                                <div class="col-md-12">
                                    <select class="form-control select2" id="kt_select2_1" name="users_involved[]" multiple="multiple" style="width: 100% !important;">
                                        
                                        @if (isset($programs) && $programs && !empty($programs->user_details))
                                            @foreach ($programs->user_details as $user)
                                                <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                            @endforeach
                                        @else
                                            <option>No User Selected</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
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
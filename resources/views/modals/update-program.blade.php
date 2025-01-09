<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="update-user-form">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Programs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" placeholder="id" id="program-id">
                    <div class="form-group col-md-12">
                        <label for="program-name">Program Name <span class="text-danger">*</span></label>
                        <select name="program_name" class="form-control" id="program-name">
                            <option value="CCS">CCS</option>
                            <option value="COE">COE</option>
                            <option value="CIT">CIT</option>      
                            <option value="COENG">COENG</option>           
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-sm-12">Users</label>
                            <div class="col-md-12">
                                <select 
                                    class="form-control select2" 
                                    id="update_users_involve" 
                                    name="users_involve[]" 
                                    multiple="multiple" 
                                    style="width: 100% !important;"
                                >
                                    <optgroup label="Faculty">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{getUserFullName($user->id)}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Program Description <span class="text-danger">*</span></label>                       
                        <div id="update_program_desc"></div>
                        <input type="hidden" name="update_program_desc_html" id="update_program_desc_html">
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
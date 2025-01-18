<div class="modal fade" id="createProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="add-user-form">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="row">
                            {{-- <div class="form-group col-md-12">
                                <label>Program Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="program_name" placeholder="Program Name">
                            </div>                             --}}
                            <div class="form-group col-md-12">
                                <label for="program-select">Program Name <span class="text-danger">*</span></label>
                                <select name="program_name" class="form-control" id="program-select">
                                    <option value="">--Select Program--</option>
                                    <option value="CCS">CCS</option>
                                    <option value="COE">COE</option>
                                    <option value="CIT">CIT</option>      
                                    <option value="COENG">COENG</option>           
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-sm-12">Users</label>
                                <div class="col-md-12">
                                    <select class="form-control select2" id="kt_select2_3" name="users_involve[]" multiple="multiple" style="width: 100% !important;">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Program Description <span class="text-danger">*</span></label>                       
                            <div id="program_desc"></div>
                            <input type="hidden" name="program_desc_html" id="program_desc_html">
                        </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success font-weight-bold">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    // alert("test")
   
</script>
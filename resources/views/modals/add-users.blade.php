<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="add-user-form">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row">
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
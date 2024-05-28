<x-app-layout>
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <form id="form-update-profile">
            <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal information</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            
                <!--begin::Body-->
                <div class="card-body">
                    <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}"/>
                    {{-- <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                        <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(assets/media/users/blank.png)">
                            <div class="image-input-wrapper" style="background-image: url(assets/media/users/300_21.jpg)"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="profile_avatar_remove"/>
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                        <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" name="first_name" value="{{$user->first_name}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                        <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" name="last_name" value="{{$user->last_name}}"/>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" value="{{$user->email}}"/>
                        <span class="form-text text-muted">Please use valid email</span>
                        </div>
                    </div> --}}
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                        <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                            <input type="number" name="phone_number" class="form-control form-control-lg form-control-solid" value="{{$user->phone_number}}" />
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                            <input type="email" name="email" class="form-control form-control-lg form-control-solid" value="{{$user->email}}" />
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mt-10 mb-6">Password</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                        <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" name="new_password" type="password" id="new_password" value=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Confirm Password</label>
                        <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" name="confirm_password" id="confirm_password" type="password" value=""/>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Company Site</label>
                        <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Username" value="loop"/>
                            <div class="input-group-append"><span class="input-group-text">.com</span></div>
                        </div>
                        </div>
                    </div> --}}
                </div>
                <!--end::Body-->
            
            </div>
        </form>
        <!--end::Form-->
     </div>
     <!--end::Content-->
    <script>
        $(document).ready(function(){

        });
        $("#form-update-profile").submit(function(e){
            e.preventDefault();
            // alert("test");
            var new_password = $("#new_password").val();
            var confirm_password = $("#confirm_password").val();
            if(new_password != "" || new_password != null){
                if(new_password === confirm_password){
                    console.log(new_password  === confirm_password);
                    var data = $(this).serialize();
                    $.ajax({
                    type: "POST",
                    url: "api/users/update-profile",
                    data: data,
                    success: function(response){
                        console.log("test", response);
                        if(response == 1){
                        
                            Swal.fire({
                                title: "Great!",
                                text: "Successfully saved.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "OK",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function(result) {
                                if (result.value) {
                                    $("#new_password").val('');
                                    $("#confirm_password").val('');
                                    location.reload();
                                }
                            });
                            
                        
                            //  getUserData();  
                            //  $("#addModal").modal('hide');                  
                        }else{
                            Swal.fire({
                                title: "Aw snap!",
                                text: "Something went wrong.",
                                icon: "error",
                                timer: 1500,
                                onOpen: function() {
                                    Swal.showLoading()
                                }
                            });
                        }
                    }
                    });
                }else{
                    Swal.fire({
                        title: "Aw snap!",
                        text: "Password dont match.",
                        icon: "error",
                        timer: 1500,
                        onOpen: function() {
                            Swal.showLoading()
                        }
                    });
                }
            }
            
        });
    </script>
</x-app-layout>

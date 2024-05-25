<x-app-layout>
    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
        <!--begin::Card-->
        <div class="card card-custom col-12">
            <div class="card-header flex-wrap py-5">
            <div class="card-title">
                <h3 class="card-label">
                    Manage Users
                </h3>
            </div>
            <div class="card-toolbar">               
                <!--begin::Button-->
                <a href="#" onclick="handleAddModalClick()" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    Add User
                </a>
                <!--end::Button-->
            </div>
            </div>
            <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="table-users">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Role</th>                       
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->first_name." ".$user->last_name}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{!!getRole($user->role)!!}</td>
                        <td>
                            <!--begin::Languages-->
                            <div class="dropdown">
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                        <i class="fa fa-cog h-20px w-20px"></i>
                                    </div>
                                </div>
                                <!--end::Toggle-->

                                <!--begin::Dropdown-->
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Nav-->
                                    <ul class="navi navi-hover py-4">

                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="#" onclick='deleteItem({{$user->id}})' class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                                                </span>
                                                <span class="navi-text">Delete</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="#" onclick='editItem({{$user->id}})' class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Edit</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->

                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Languages-->
                        </td>
                    </tr>   
                    @endforeach
                          
                </tbody>
            </table>
            <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    @include('modals.add-users')
    @include('modals.update-users')
    <script> 
        // --- for users
        $(document).ready(function(){
            // alert("test");
            $('#table-users').DataTable();
        });
        function handleAddModalClick(){
            $("#addModal").modal('show');
        };

        function deleteItem(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: `api/users/delete/${id}`,
                            success: function(response){
                                console.log("test-----------", response);
                                Swal.fire(
                                    "Deleted!",
                                    "Your file has been deleted.",
                                    "success"
                                )
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText); // Log the error response for debugging
                                Swal.fire(
                                    "Error!",
                                    "An error occurred while deleting the item.",
                                    "error"
                                );
                                // Optionally, you can provide more specific error messages to the user based on the error status.
                            }
                    })
                  
                }
            });
        }

        function editItem(id){
            $.ajax({
               type: "GET",
               url: `api/users/get/${id}`,
                success: function(response){
                    console.log("test", response);
                    $("#updateModal").modal('show');
                    $("#user-id").val(response?.id)
                    $("#user-first-name").val(response?.first_name)
                    $("#user-last-name").val(response?.last_name)
                    $("#user-email").val(response?.email)
                    $("#user-phone-number").val(response?.phone_number)
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the error response for debugging
                    Swal.fire(
                        "Error!",
                        "An error occurred while deleting the item.",
                        "error"
                    );
                    // Optionally, you can provide more specific error messages to the user based on the error status.
                }
             })
        }


        $('#add-user-form').submit(function(e){
             e.preventDefault();
             var data = $(this).serialize();

             $.ajax({
               type: "POST",
               url: "api/users/add",
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
             })
         });

         $('#update-user-form').submit(function(e){
             e.preventDefault();
             var data = $(this).serialize();

             $.ajax({
               type: "POST",
               url: "api/users/update",
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
             })
         });

     </script>
</x-app-layout>
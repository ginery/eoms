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
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
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
                        <td>{{$user->role}}</td>
                        <td nowrap></td>
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
    <script> 
        // --- for users
        $(document).ready(function(){
            $('#kt_datatable1').DataTable();
        });
        function getUserData() {
            // $('#kt_datatable1').dataTable().destroy(); 
            $('#kt_datatable1').dataTable(); 
        }   
        function handleAddModalClick(){
            $("#addModal").modal('show');
        };
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
     
     </script>
</x-app-layout>
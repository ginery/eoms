<x-app-layout>
    <!--begin::Body-->
    	<!--begin::Subheader-->
            <div class="subheader py-2 py-lg-6  subheader-solid" id="kt_subheader">
                <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">

                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">
                                Proposed
                            </h5>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->

                    <!--begin::Toolbar-->
                    
                    <div class="d-flex align-items-center">
                        <!--begin::Actions-->
                            <a href="#" onclick='handleCreateFolder(0)' class="btn btn-light-primary font-weight-bolder btn-sm mr-2">
                                <i class="fa fa-plus text-primary" style="font-size:12px; color:#047940 !important"></i>
                                Program 
                            </a>
{{-- 
                            <a href="#" onclick='handleDocumentClick(0)' class="btn btn-light-primary font-weight-bolder btn-sm">
                                <i class="fa fa-plus text-primary" style="font-size:12px; color:#047940 !important"></i>
                                Document 
                            </a> --}}
                        <!--end::Actions-->
                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
        <!--end::Subheader-->

            <div class="card-body p-0 position-relative mt-15">
                @foreach($programs as $program)
                    <!--begin::Card-->
                    <div class="card card-custom mb-2" style="cursor: pointer;">
                        <div class="card-header">
                            <div class="card-title" style="width: 90%;" onclick="handleFolderClick({{$program->id}})">
                                <span class="card-icon">
                                    <i class="fa fa-folder text-success" style="font-size:30px;"></i>
                                </span>
                                <h3 class="card-label">
                                    {{$program->program_name}}
                                </h3>
                                <div>
                                    <span class="label label-light-info label-inline font-weight-bold"> {{getTotalProject($program->id, 0)}}</span>                                   
                                </div>
                                {{-- @if (Auth::user()->role != 0)
                                    <small>{{getUserFullName($document->user_id)}}</small>
                                @endif --}}
                            </div>
                            
                            <!--begin::Languages-->
                            <div class="dropdown mt-4" >
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg">
                                        <i class="fa fa-cog h-20px w-20px"></i>
                                    </div>
                                </div>
                                <!--end::Toggle-->

                                <!--begin::Dropdown-->
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Nav-->
                                    <ul class="navi navi-hover py-4">
                                        <!--begin::Item-->
                                        {{-- <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleDeleteFolder({{$program->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                                                </span>
                                                <span class="navi-text">Delete</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleEditFolder({{$program->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Edit</span>
                                            </a>
                                        </li> --}}

                                        <!--begin::Item-->                                       
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleRequirements({{$program->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-tasks"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Requirements</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleProgramUpdateStatus({{$program->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-check"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Approve Program</span>
                                            </a>
                                        </li>
                                        {{-- <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleRequirements({{$program->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-info-circle"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Details</span>
                                            </a>
                                        </li> --}}
                                        <!--end::Item-->

                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Languages-->
                        </div>
                    </div>
                    <!--end::Card-->
                @endforeach
            </div>
    <!--end::Body-->

    @include('modals.create-folder-document')
    @include('modals.update-folder-document')
    @include('modals.create-program')
    {{-- @include('modals.add-document') --}}
    

    <!-- jQuery Script -->
    <script>
         const quill = new Quill('#program_desc', {
            theme: 'snow'
        });
        function handleFolderClick(id) {            
            location.href = "/propose/"+id;
        }

        function handleCreateFolder(){
            $("#createProgram").modal('show');
            $.ajax({
               type: "GET",
               url: "api/programs/get_user_tag",
               success: function(response){
                $('#kt_select2_3').empty();
                console.log("selectedProgram", response);
                if (response && response.length > 0) {
                    // Populate Users dropdown with the fetched data
                    response.forEach(function (user) {
                        var fullName = `${user.first_name} ${user.last_name}`;
                        var newOption = new Option(fullName, user.id, false, false);
                        $('#kt_select2_3').append(newOption);
                    });

                    // Refresh Select2 to show the new options
                    $('#kt_select2_3').trigger('change');
                } else {
                    // If no users are found, add a placeholder option
                    var noUserOption = new Option("No users available", "", false, false);
                    $('#kt_select2_3').append(noUserOption);
                }
               }
            });
        }


        function handleDeleteFolder(id){
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
                        url: `api/documents/delete-documents`,
                        data:{id:id},
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

        function handleEditFolder(id){
            $.ajax({
               type: "GET",
               url: `api/documents/get-documentstoedit/${id}`,
                success: function(response){
                    console.log("test", response[0]);
                    $("#updateFolderModal").modal('show');
                    $("#document-id").val(response[0]?.id)
                    $("#document-name").val(response[0]?.document_name)
                    $("#document-description").val(response[0]?.description)
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
        };

        function handleDocumentClick(id){
            $("#addDocumentModal").modal('show');
        }

        $('#create-folder-document-form').submit(function(e){
             e.preventDefault();
             var data = $(this).serialize();
             console.log("data serialize========",data)

             $.ajax({
               type: "POST",
               url: "api/documents/add-documents",
               data: data,
               success: function(response){
                  console.log("test", response);
                  if(response == 1){
                    $("#createFolderModal").modal('hide');
                    Swal.fire({
                        title: "Great!",
                        text: "Successfully created.",
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

        $('#update-folder-document-form').submit(function(e){
             e.preventDefault();
             var data = $(this).serialize();

             console.log("|data=====",data)

             $.ajax({
               type: "POST",
               url: "api/documents/update-documents",
               data: data,
               success: function(response){
                  console.log("test-------", response);
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

        $('#add-user-form').submit(function(e){
             e.preventDefault();
             const quillContent = quill.root.innerHTML;
             document.getElementById('program_desc_html').value = quillContent;

             var data = $(this).serialize();

             $.ajax({
               type: "POST",
               url: "api/programs/add",
               data: data,
               success: function(response){
                  if(response === '1'){
                   
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
                  }else if(response === '2') {
                    Swal.fire({
                        title: "Aw snap!",
                        text: "Program already exist.",
                        icon: "error",
                        timer: 1500,
                        onOpen: function() {
                            Swal.showLoading()
                        }
                    });
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

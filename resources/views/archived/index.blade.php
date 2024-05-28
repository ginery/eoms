<x-app-layout>
    <!--begin::Body-->
            <div class="card-body p-0 position-relative mt-15">
                @foreach($documents as $document)
                    <!--begin::Card-->
                    <div class="card card-custom mb-2" style="cursor: pointer;">
                        <div class="card-header">
                            <div class="card-title" style="width: 90%;" onclick="handleFolderClick({{$document->id}})">
                                <span class="card-icon">
                                    @if ($document->document_type === 'pdf')
                                    <i class="fas fa-file-pdf" class="text-success" style="font-size:30px;"></i>
                                    @elseif ($document->document_type === 'docx')
                                    <i class="fas fa-file-word" style="font-size:30px; color:blue !important"></i>
                                    @elseif ($document->document_type === 'jpg' || $document->document_type === 'png' || $document->document_type === 'gif' || $document->document_type === 'jpeg')
                                    <i class="fas fa-image" style="font-size:30px; color:grey !important"></i>
                                    @endif      
                                </span>
                                <h3 class="card-label">
                                    {{$document->document_name}}
                                </h3>
                                @if (Auth::user()->role === 1)
                                    <small>{{getUserFullName($document->user_id)}}</small>
                                @endif
                                {!!getDocumentStatus($document->status)!!}
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
                                        @if (Auth::user()->role != 0)
                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleDeleteFolder({{$document->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                                                </span>
                                                <span class="navi-text">Delete</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        @endif

                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleEditFolder({{$document->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Edit</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        <li class="navi-item">
                                            <a href="{{ asset('assets/uploads/' . $document->document_name) }}" class="navi-link" download="{{ $document->document_name }}">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-archive"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Download</span>
                                            </a>
                                        </li>

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


    <!-- jQuery Script -->
    <script>
        function handleFolderClick(id) {            
            location.href = "/documents/"+id;
        }

        function handleCreateFolder(){
            $("#createFolderModal").modal('show');
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
                        url: `api/documents/delete-documents/${id}`,
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






    </script>
</x-app-layout>

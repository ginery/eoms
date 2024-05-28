<x-app-layout>
    <!--begin::Subheader-->
    @php
        $currentPath = request()->path();
        $urlPath = explode('/', $currentPath);
    @endphp
    <div class="subheader py-2 py-lg-6  subheader-solid" id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">
                        {{getFolderName($urlPath[1])}}
                    </h5>
                    <!--end::Page Title-->

                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['url'] }}" class="text-muted">{{ $breadcrumb['name'] }}</a>
                            </li>
                            @endforeach

                        </ul>
                        <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                    <a href="#" onclick='handleCreateFolder()' class="btn btn-light-success font-weight-bolder btn-sm mr-3">
                        <i class="fa fa-plus text-success" style="font-size:12px;"></i>
                        Folder
                    </a>
                    <a href="#" onclick='handleDocumentClick()' class="btn btn-light-success font-weight-bolder btn-sm" >
                        <i class="fa fa-plus text-success" style="font-size:12px;"></i>
                        Document
                    </a>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
<!--end::Subheader-->
<div class="card-body p-0 position-relative mt-15">
    @foreach($documents as $document)
        <!--begin::Card-->
        @if ($document->document_type == null)
        <div class="card card-custom mb-2" style="cursor: pointer;" >
            <div class="card-header" >
                <div class="card-title" style="width: 90%;" onclick="handleFolderClick({{$document->id}})">
                    <span class="card-icon">
                        <i class="fa fa-folder text-success" style="font-size:30px; "></i>
                    </span>
                    <h3 class="card-label">
                        {{$document->document_name}}
                    </h3>
                    @if (Auth::user()->role === 1)
                    <small>{{getUserFullName($document->user_id)}}</small>
                    @endif
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
                            @if (Auth::user()->role === 1)
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

                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->
            </div>
        </div>
        @else
        <div class="card card-custom mb-2" style="cursor: pointer;">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon"> 
                        @if ($document->document_type === 'pdf')
                        <i class="fas fa-file-pdf" class="text-success" style="font-size:30px; color:red !important"></i>
                        @elseif ($document->document_type === 'docx')
                        <i class="fas fa-file-word" style="font-size:30px; color:blue !important"></i>
                        @elseif ($document->document_type === 'xlsx')
                        <i class="fas fa-file-excel" style="font-size:30px; color:green !important"></i>
                        @elseif ($document->document_type === 'jpg' || $document->document_type === 'png' || $document->document_type === 'gif' || $document->document_type === 'jpeg')
                        <i class="fas fa-image" style="font-size:30px; color:grey !important"></i>
                        @elseif ($document->document_type === 'pptx')
                        <i class="fas fa-file-powerpoint" style="font-size:30px; color:rgb(255, 94, 0) !important"></i>
                        @else
                        <i class="fas fa-file-alt" style="font-size:30px; color:rgb(146, 9, 226) !important"></i>
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
                            <!--begin::Item-->
                            {{-- <li class="navi-item">
                                <a href="#" class="navi-link" onclick="handleDeleteFolder({{$document->id}},'{{$document->document_type}}','{{$document->document_name}}')">
                                    <span class="symbol symbol-20 mr-3">
                                        <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                                    </span>
                                    <span class="navi-text">Delete</span>
                                </a>
                            </li> --}}
                            <!--end::Item-->

                            @if(Auth::user()->role === 2 && Auth::user()->role === $document->user_id)
                                <!--begin::Item-->
                                <li class="navi-item">
                                    <a href="#" class="navi-link" onclick="handleDeleteFolder({{$document->id}},'{{$document->document_type}}','{{$document->document_name}}')">
                                        <span class="symbol symbol-20 mr-3">
                                            <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                                        </span>
                                        <span class="navi-text">Delete</span>
                                    </a>
                                </li>
                                <!--end::Item-->
                            @elseif(Auth::user()->role === 1)
                                <!--begin::Item-->
                                <li class="navi-item">
                                    <a href="#" class="navi-link" onclick="handleDeleteFolder({{$document->id}},'{{$document->document_type}}','{{$document->document_name}}')">
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
                            @if(Auth::user()->role == 1)
                                @if($document->status == 0)
                                    <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleAccepted({{$document->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-check"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Accepted</span>
                                            </a>
                                        </li>
                                    <!--end::Item-->

                                @elseif($document->status == 3 || $document->status == 1 )
                                    <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleCompleteClick({{$document->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-check"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Completed</span>
                                            </a>
                                        </li>
                                    <!--end::Item-->
                                @endif  

                                 <!--begin::Item-->
                                 @if($document->status !== '-1')
                                    <li class="navi-item">
                                        <a href="#" class="navi-link" onclick="handleRejected({{$document->id}})">
                                            <span class="symbol symbol-20 mr-3">
                                                <i class="fas fa-times"></i><!-- Font Awesome edit icon -->
                                            </span>
                                            <span class="navi-text">Rejected</span>
                                        </a>
                                    </li>
                                @endif
                                <!--end::Item-->
                            @endif

                           



                            <!--begin::Item-->
                            @if($document->status == 1)
                                <li class="navi-item">
                                    <a href="#" class="navi-link" onclick="handleArchivedClick({{$document->id}})">
                                        <span class="symbol symbol-20 mr-3">
                                            <i class="fas fa-archive"></i> <!-- Font Awesome edit icon -->
                                        </span>
                                        <span class="navi-text">Archived</span>
                                    </a>
                                </li>
                            @endif
                          

                            <li class="navi-item">
                                <a href="{{ asset('assets/uploads/' . $document->document_name) }}" class="navi-link" download="{{ $document->document_name }}">
                                    <span class="symbol symbol-20 mr-3">
                                        <i class="fas fa-download"></i><!-- Font Awesome edit icon -->
                                    </span>
                                    <span class="navi-text">Download</span>
                                </a>
                            </li>
                            <!--end::Item-->

                            @if($document->document_type !== null)
                            <!--begin::Item-->
                            <li class="navi-item">
                                <a href="#" class="navi-link" onclick="handleView({{$document->id}})">
                                    <span class="symbol symbol-20 mr-3">
                                        <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                    </span>
                                    <span class="navi-text">View</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endif

                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->
            </div>
        </div>

        @endif
        <!--end::Card-->
    @endforeach
</div>
    @include('modals.create-folder-document')
    @include('modals.add-document')
    @include('modals.view-file-document')
    @include('modals.update-folder-document')
    <script>
        $(document).ready(function(){
            FilePond.create(document.getElementById('filepond'));    

            $('.delete-button').click(function() {
                var fileName = $(this).data('file-name'); // Assuming you have a data attribute with the file name

                $.ajax({
                    url: '/delete-file',
                    type: 'DELETE',
                    contentType: 'application/json',
                    data: JSON.stringify({ file_name: fileName }),
                    success: function(response) {
                        if (response.success) {
                            alert('File deleted successfully');
                            // Optionally, remove the file element from the DOM
                            $('#file-' + fileName).remove(); // Assuming each file has an ID corresponding to the file name
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the file.');
                    }
                });
            });
        });
        function handleCompleteClick(id){
            $.ajax({
               type: "POST",
               url: baseUrl+"/api/archived/complete",
               data: {
                id: id
               },
               success: function(response){
                  console.log("test", response);
                  if(response == 1){
                    Swal.fire({
                        title: "Great!",
                        text: "Completed",
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
            });
        }
        function handleArchivedClick(id) {
            $.ajax({
               type: "POST",
               url: baseUrl+"/api/archived/update",
               data: {
                id: id
               },
               success: function(response){
                  console.log("test", response);
                  if(response == 1){
                    Swal.fire({
                        title: "Great!",
                        text: "Successfully archived.",
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
            });
        }

        function handleRejected(id) {
            $.ajax({
               type: "POST",
               url: baseUrl+"/api/documents/update-status",
               data: {
                id: id,
                status:-1
               },
               success: function(response){
                  console.log("test", response);
                  if(response == 1){
                    Swal.fire({
                        title: "Great!",
                        text: "Successfully archived.",
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
            });
        }

        function handleAccepted(id) {
            $.ajax({
               type: "POST",
               url: baseUrl+"/api/documents/update-status",
               data: {
                id: id,
                status:3
               },
               success: function(response){
                  console.log("test", response);
                  if(response == 1){
                    Swal.fire({
                        title: "Great!",
                        text: "Successfully archived.",
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
            });
        }

        function handleEditFolder(id){
            $.ajax({
               type: "GET",
               url: baseUrl+`/api/documents/get-documentstoedit/${id}`,
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
        
        function handleDeleteFolder(id,type,name){
            if(!type){
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
                            url: baseUrl+`/api/documents/delete-documents`,
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
            }else{
                // var fileName = $(this).data('document_name'); 
                console.log("may type",name)

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true, 
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: baseUrl+`/api/documents/delete-file`,
                            type: 'DELETE',
                            contentType: 'application/json',
                            data: JSON.stringify({ file_name: name }),
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        "Deleted!",
                                        "Your file has been deleted.",
                                        "success"
                                    )

                                    $('#file-' + name).remove(); // Assuming each file has an ID corresponding to the file name
                                    location.reload();
                                } else {
                                    alert('Error: ' + response.message);
                                    Swal.fire(
                                        'Error: ' + response.message
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                alert('An error occurred while deleting the file.');
                            }
                        });

                    
                    }
                });

                
            }
        }

        function handleView(id) {
            $("#viewFileModal").modal("show");
            $.ajax({
                url: baseUrl+'/api/documents/documents/' + id,
                type: 'GET',
                success: function(response) {
                    $('#viewFileModalLabel').text(response.document_name);

                    console.log("response=----------",response.document_name)
                    let content = '';
                    var phpUrl = "{{ asset('') }}"; // Get the base URL of your Laravel application
                    var customPath = phpUrl + "/assets/uploads/" + response.document_name;


                    if (response.fileType === 'pdf') {
                        content = `<iframe src="${response.filePath}" width="100%" height="600px"></iframe>`;
                    } else if (['jpg', 'jpeg', 'png', 'gif'].includes(response.fileType)) {
                        content = `<img src="${response.filePath}" alt="${response.document_name}" width="100%" height="600px"/>`;
                    } 
                    // else if (response.fileType === 'docx') {
                    //     content = `<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=http://127.0.0.1:8000/assets/uploads/1716774616-data-dictionary-template.docx" width="100%" height="600px"></iframe>`;
                    // //     $('#viewFileModalBody').html(content);
                    // //     $('#viewFileModal').modal('show');
                    // console.log(customPath)
                    // mammoth.convertToHtml({path: `${customPath}`})
                    // .then(function(result) {
                    //     // $('#viewFileModalBody').html(result.value);
                    //         content = result.value; // The generated HTML
                    //         var messages = result.messages;
                    //     }).catch(function(err) {
                    //         console.log(err);
                    //         $('#viewFileModalBody').html('<p>Failed to load document.</p>');
                    //     }); 
                    // } 
                    else {
                         content = '<p>Unsupported file type.</p>';
                        console.log(response.filePath);
                    
                    }
                    $('#viewFileModalBody').html(content);
                   
                },
                error: function(xhr) {
                    alert('An error occurred while trying to fetch the document.');
                }
            });
        }

        function handleDocumentClick(id){
            $("#addDocumentModal").modal('show');
        }
        function handleFolderClick(id) {            
            location.href = "/documents/"+id;
        }
        function handleCreateFolder(){
            var folder_id = {{$urlPath[1]}};
            $("#createFolderModal").modal('show');
            $("#folder_id").val(folder_id);
        }




        $('#create-folder-document-form').submit(function(e){
             e.preventDefault();
             var data = $(this).serialize();
             console.log("data serialize========",baseUrl+"api/documents/add-documents")

            $.ajax({
               type: "POST",
               url: baseUrl+"/api/documents/add-documents",
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
            });
        });
        
        
        $('#uploadForm').submit(function(event) {
            event.preventDefault(); 
            const folder_id = $('#folder_id_files').val();
            const user_id = $('#user_id').val();
            console.log("userid=======",user_id)
            const pond = FilePond.find(document.getElementById('filepond'));
            const files = pond.getFiles();       
            const formData = new FormData();

            files.forEach(file => {
                formData.append('files[]', file.file);
            });
            formData.append('folder_id',folder_id);
            formData.append('user_id', user_id);
            $.ajax({
                url: baseUrl+'/api/documents/upload',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if(response == 1){
                        Swal.fire({
                            title: "Great!",
                            text: "Successfully added.",
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
                },
                error: function(xhr, status, error) {
                    console.error('Error uploading files:', error);
                }
            });
        
        });    
        
        $('#update-folder-document-form').submit(function(e){
             e.preventDefault();
             var data = $(this).serialize();

             console.log("|data=====",data)

             $.ajax({
               type: "POST",
               url: baseUrl +"/api/documents/update-documents",
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
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
                                REICO
                            </h5>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->

                    <!--begin::Toolbar-->
                    {{-- <div class="d-flex align-items-center">
                        <!--begin::Actions-->
                            <a href="#" onclick='handleCreateFolder()' class="btn btn-light-primary font-weight-bolder btn-sm">
                                <i class="fa fa-plus text-primary" style="font-size:12px; color:#047940 !important"></i>
                                Project 
                            </a>
                        <!--end::Actions-->
                    </div> --}}
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
                                    <span class="label label-light-info label-inline font-weight-bold"> {{getTotalProject($program->id, 3)}}</span>                                   
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
                                        <li class="navi-item">
                                            <a href="#" class="navi-link" onclick="handleRequirements({{$program->id}})">
                                                <span class="symbol symbol-20 mr-3">
                                                    <i class="fas fa-tasks"></i> <!-- Font Awesome edit icon -->
                                                </span>
                                                <span class="navi-text">Requirements</span>
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
            location.href = "/in-progress/"+id;
        }

    </script>
</x-app-layout>

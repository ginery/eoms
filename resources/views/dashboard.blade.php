<x-app-layout>
    <!--begin::Content-->
    {{-- <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">                 --}}
       <!--begin::Entry-->
                           <!--begin::Entry-->
      <div class="d-flex flex-column-fluid">
       <!--begin::Container-->
          <div class=" container ">
           <div class="d-flex flex-column-fluid">
              <!--begin::Container-->
              <div class="container">                
                 <!--begin::Dashboard-->
                 <!--begin::Row-->
                
                 <div class="row">
                    @if(Auth::user()->role != 0)
                    <div class="col-lg-12">
                        <div class="row m-0">
                            <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                                        </g>
                                    </svg>
                                </span> 
                                <div class="row" style="justify-content: space-between;">
                                    <a href="{{route('programs')}}" class="text-warning font-weight-bold font-size-h6">
                                        Total Programs
                                    </a>
                                    <h1 class="text-warning">{{$programs}}</h1>
                                </div> 
                            </div>
                            <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg></span>
                                <div class="row" style="justify-content: space-between;">
                                    <a href="{{route('users')}}" class="text-primary font-weight-bold font-size-h6 mt-2">
                                        Total Users
                                    </a>
                                    <h1 class="text-primary">{{$users}}</h1>
                                </div>                                                      
                            </div>                      
                        </div>
                    </div>
                  
                    {{-- programs counter --}}
                    <div class="col-lg-12">
                        <div class="row m-0">
                            <div class="col bg-light-info px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 Z" fill="#000000"/>
                                        <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg>
                                </span> 
                                <div class="row" style="justify-content: space-between;">
                                    <a href="{{route('programs')}}" class="text-info font-weight-bold font-size-h6">
                                        CCS
                                    </a>
                                    <h1 class="text-info">{{$programs_css}}</h1>
                                </div> 
                            </div>
                            <div class="col bg-light-info px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 Z" fill="#000000"/>
                                        <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg></span>
                                <div class="row" style="justify-content: space-between;">
                                    <a href="{{route('users')}}" class="text-info font-weight-bold font-size-h6 mt-2">
                                        COE
                                    </a>
                                    <h1 class="text-info">{{$programs_coe}}</h1>
                                </div>                                                      
                            </div>  
                            <div class="col bg-light-info px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 Z" fill="#000000"/>
                                        <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg></span>
                                <div class="row" style="justify-content: space-between;">
                                    <a href="{{route('users')}}" class="text-info font-weight-bold font-size-h6 mt-2">
                                        CIT
                                    </a>
                                    <h1 class="text-info">{{$programs_cit}}</h1>
                                </div>                                                      
                            </div>   
                            <div class="col bg-light-info px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18 Z" fill="#000000"/>
                                        <path d="M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg></span>
                                <div class="row" style="justify-content: space-between;">
                                    <a href="{{route('users')}}" class="text-info font-weight-bold font-size-h6 mt-2">
                                        COENG
                                    </a>
                                    <h1 class="text-info">{{$programs_coeng}}</h1>
                                </div>                                                      
                            </div>                       
                        </div>
                    </div>
                    @endif
                    <div id="bar-chart" class="col-lg-6" style="height: 300px"></div>
                    <div class="col-lg-6" style="height: 325px">
                       <!--begin::List Widget 9-->
                       <div class="card card-custom card-stretch gutter-b">
                           <!--begin::Header-->
                           <div class="card-header align-items-center border-0 mt-4">
                               <h3 class="card-title align-items-start flex-column">
                                   <span class="font-weight-bolder text-dark">Roadmap</span>
                                   {{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">2 Project</span> --}}
                               </h3>                              
                           </div>
                           <!--end::Header-->
                       
                           <!--begin::Body-->
                           <div class="card-body pt-4" style="height: 325px; overflow: auto;">
                               <!--begin::Timeline-->
                               <div class="timeline timeline-6 mt-3">
                                   @foreach ($projects as $project)
                                         <!--begin::Item-->
                                       <div class="timeline-item align-items-start">
                                           <!--begin::Label-->
                                           <div class="timeline-label font-weight-bolder text-dark-75 font-size-sm"> {{$project->formatted_date}}</div>
                                           <!--end::Label-->
                       
                                           <!--begin::Badge-->
                                           <div class="timeline-badge">
                                               <i class="fa fa-genderless text-{{roadmapStatus($project->status)}} icon-xl"></i>
                                               
                                           </div>
                                           <!--end::Badge-->
                       
                                           <!--begin::Text-->
                                           <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                               {{$project->name}} --  {!!getDocumentStatus($project->status)!!} <span style="font-size: 9px;  font-style: italic; color: gray;"> {{getUserFullName($project->added_by)}}</span>
                 
                                                  
                                         
                                           </div>
                                           <!--end::Text-->
                                       </div>
                                       <!--end::Item-->
                                   @endforeach
                                   <!--begin::Item-->                                        
                                </div>
                               <!--end::Timeline-->
                           </div>
                           <!--end: Card Body-->
                       </div>
                       <!--end: List Widget 9-->
                       </div>                      
                 </div>
                 <!--end::Row-->
                 <!--end::Dashboard-->
                 {{-- <a href="javascript:;" id="kt_notify_btn" onclick="test()" class="btn btn-success">Test</a> --}}
              </div>
              <!--end::Container-->
           </div>  
       <!--end::Entry-->
       </div>
       
    </div>
    <!--end::Content-->
    @include('modals.dashboard-status')
  <script>
  document.addEventListener('DOMContentLoaded', function () {
       const chart = Highcharts.chart('bar-chart', {
           chart: {
               type: 'column'
           },
           title: {
               text: 'Program Reports'
           },
           xAxis: {
               categories: ['Completed', 'In-progress', 'Rejected','Archived']
           },
           yAxis: {
               title: {
                   text: 'Total Programs'
               }
           },
           series: [{
               name: 'Total Documents',
               data: [{{ $completed }}, {{$inprogress}}, {{$rejected}}, {{$archived}}]
           }]
       });
   });
   function test(){
     // KTBootstrapNotifyDemo.notify('Your custom message here', 'Custom Title', 'danger');
     $.ajax({
        type: "POST",
        url: "api/dashboard/test",
        data: {
           test: 'test'
        },
        success: function(response){
           console.log("test", response)
        }

     });
   }
    function handleStatusClick(status){
     
     $("#dashboardStatus").modal("show");
     $("#table-body-status").html("");
     var user_id = "{{Auth::id()}}";
     var role_id = "{{Auth::user()->role}}";
     // console.log("test", role_id);
     $.ajax({
        type: "POST",
        url: "api/dashboard/dashboard-status",
        data: {
           document_status: status,
           user_id: user_id,
           role_id: role_id
        },
        success: function(response){
           console.log(response);
           for (var i = 0; i < response.length; i++) {
              
              $("#table-body-status").append('<tr>'+
                               '<th scope="row">'+(i+1)+'</th>'+
                               '<td>'+response[i].document_name+'</td>'+
                               '<td>'+response[i].document_size+'</td>'+
                               '<td>'+response[i].date_added+'</td>'+
                           '</tr>');
           }
           
        }
     });
    }
  </script>
</x-app-layout>

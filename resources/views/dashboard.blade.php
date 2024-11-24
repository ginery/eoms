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

<x-app-layout>
    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
    <!--begin::Card-->    
    <div class="card card-custom col-12">
        <div class="row mt-5 ">
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="text" class="form-control start_date" readonly  id="kt_datepicker_2" placeholder="Select date">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>   
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="text" class="form-control end_date" readonly id="kt_datepicker_2" placeholder="Select date">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role != 0)
                
            <div class="col-md-3">
                <div class="input-group date">

                    <select class="form-control users-report select2" id="kt_select2_3" name="users"  style="width: 100% !important;">
                        <optgroup label="users">
                            <option value="0">All</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                            @endforeach
                        </optgroup>
                    </select>          
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group date">

                    <select class="form-control programs-report select2" id="kt_select2_2" name="programs" style="width: 100% !important;">
                        <optgroup label="programs">
                            <option value="0">All</option>
                            @foreach($programs as $program)
                                <option value="{{$program->id}}">{{$program->program_name}}</option>
                            @endforeach
                        </optgroup>
                    </select>          
                </div>
            </div>
           
            @endif
            <div class="col-md-3 {{Auth::user()->role != 0 ? 'mt-3':''}}">
                <div class="input-group date">

                    <select class="form-control status-report select2" id="kt_select2_1" name="status" style="width: 100% !important;">
                        <optgroup label="status">
                            <option value="0">All</option>
                            <option value="0">Pending</option>
                            <option value="1">Technical Review</option>
                            <option value="2">REICO</option>
                            <option value="3">Implementation</option>
                            <option value="4">Completed</option>
                            <option value="-1">Rejected</option>
                            <option value="5">Archived</option>
                        </optgroup>
                    </select>          
                </div>
            </div>
            <input type="hidden" value="{{Auth::id()}}" id="user_id"/>
            <input type="hidden" value="{{Auth::user()->role}}" id="role_id"/>
            <div class="col-md-3 {{Auth::user()->role != 0 ? 'mt-3':''}}">
                <button type="button" onclick="generateReport()" class="btn btn-success font-weight-bold">Generate</button>
            </div>          
        </div>
    <div class="card-body">
    <table class="table table-separate table-head-custom table-checkable table-responsive" id="table-reports">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Document Name</th>
                <th scope="col">Document Type</th>
                <th scope="col">Document Size</th>
                <th scope="col">Description</th>
                <th scope="col">User</th>
                <th scope="col" style="width: 200px !important;">Status</th>
                <th scope="col">Date Added</th>
            </tr>
        </thead>
        <tbody>          
        </tbody>
    </table>
    </div>
</div>
</div>
    <script>
        $(document).ready(function(){        
            var currentDate = moment();
            var startDate = currentDate.clone().startOf('month').format('MM/DD/YYYY');
            var endDate = currentDate.clone().endOf('month').format('MM/DD/YYYY');
            $('.start_date').val(startDate);
            $('.end_date').val(endDate);
            generateReport();
        });
        function generateReport(id){
            var role = "{{Auth::user()->role}}";
            var start_date =  $('.start_date').val();
            var end_date = $('.end_date').val();
            if(role === '0'){
                var user_id = $("#user_id").val();              
            }else{
                var user_id = $(".users-report").val();
            }
           
            var program_id = $(".programs-report").val();
            var status_id = $(".status-report").val();
            // var user_id = $("#user_id").val() ? $("#user_id").val():users;
            var role_id = $("#role_id").val();
          
            console.log("generateReport", role);
            // return;
            $("#table-reports").DataTable().destroy();
            $("#table-reports").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                searching: false, 
                paging: false,
                info: false,                
                ajax: {
                    url: 'api/reports/generate',
                    type: 'GET',                    
                    dataSrc: 'data',
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                        user_id: user_id,
                        role_id: role_id,
                        program_id: program_id,
                        status_id: status_id
                    },                   
                },
                columns: [
                    { data: 'counter' },
                    { data: 'document_name' },
                    { data: 'document_type' },
                    { data: 'document_size' },
                    { data: 'description' },
                    { data: 'user_name' },
                    { data: 'status' },
                    { data: 'date_added' }
                ],   
            });
            $.ajax({
                url: 'api/reports/generate',
                type: 'GET',
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    user_id: user_id,
                    role_id: role_id,
                    program_id: program_id,
                    status_id: status_id
                },success: function(e){
                    console.log(e);
                },
                error: function(e){
                    console.log("error", e);
                }
            })

        }
        
    </script>
</x-app-layout>
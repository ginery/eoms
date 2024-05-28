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
            <input type="hidden" value="{{Auth::id()}}" id="user_id"/>
            <input type="hidden" value="{{Auth::user()->role}}" id="role_id"/>
            <div class="col-md-3">
                <button type="button" onclick="generateReport()" class="btn btn-success font-weight-bold">Generate</button>
            </div>          
        </div>
    <div class="card-body">
    <table class="table table-separate table-head-custom table-checkable" id="table-reports">
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
            var start_date =  $('.start_date').val();
            var end_date = $('.end_date').val();
            var user_id = $("#user_id").val();
            var role_id = $("#role_id").val();
            console.log(start_date);
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
                        role_id: role_id
                    },                   
                },
                columns: [
                    { data: 'counter' },
                    { data: 'document_name' },
                    { data: 'document_type' },
                    { data: 'document_size' },
                    { data: 'description' },
                    { data: 'user_id' },
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
                    role_id: role_id
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
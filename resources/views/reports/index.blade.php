<x-app-layout>
    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
    <!--begin::Card-->    
    <div class="card card-custom col-12">
        <div class="row mt-5 ">
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="text" class="form-control" id="start_date" readonly="" placeholder="Select date">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>   
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="text" class="form-control" id="end_date" readonly="" placeholder="Select date">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>
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
                <th scope="col">Document Size</th>
                <th scope="col">Status</th>
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
            var startDate = currentDate.clone().startOf('month').format('YYYY-MM-DD');
            var endDate = currentDate.clone().endOf('month').format('YYYY-MM-DD');
            $('#start_date').val(startDate);
            $('#end_date').val(endDate);

            generateReport();
        });
        function generateReport(){
            var start_date =  $('#start_date').val();
            var end_date = $('#end_date').val();
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
                        end_date: end_date
                    },                   
                },
                columns: [
                    { data: 'id' },
                    { data: 'document_name' },
                    { data: 'document_type' },
                    { data: 'document_size' },
                    { data: 'description' },
                    { data: 'user_id' },
                    { data: 'status' },
                    { data: 'date_added' }
                ],   
            });

        }
        
    </script>
</x-app-layout>
<x-app-layout>
    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
    <!--begin::Card-->
    <div class="card card-custom col-12">
    <div class="card-body">
    <table class="table table-separate table-head-custom table-checkable" id="table-reports">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Nick</td>
                <td>Stone</td>
                <td>
                    <span class="label label-inline label-light-primary font-weight-bold">
                        Pending
                    </span>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Ana</td>
                <td>Jacobs</td>
                <td>
                    <span class="label label-inline label-light-success font-weight-bold">
                        Approved
                    </span>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>Pettis</td>
                <td>
                    <span class="label label-inline label-light-danger font-weight-bold">
                        New
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
</div>
    <script>
        $(document).ready(function(){
            $("#table-reports").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
        });
        
    </script>
</x-app-layout>
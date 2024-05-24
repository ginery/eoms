<x-app-layout>
    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
            <div class="card-title">
                <h3 class="card-label">
                    Manage Users
                </h3>
            </div>
            <div class="card-toolbar">               
                <!--begin::Button-->
                <a href="#" onclick="handleAddModalClick()" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    Add User
                </a>
                <!--end::Button-->
            </div>
            </div>
            <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Company Email</th>
                        <th>Company Agent</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>hboule0@hp.com</td>
                        <td>Hayes Boule</td>
                        <td>Casper-Kerluke</td>
                        <td>5</td>
                        <td>1</td>
                        <td nowrap></td>
                    </tr>             
                </tbody>
            </table>
            <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    @include('modals.add-users')
</x-app-layout>
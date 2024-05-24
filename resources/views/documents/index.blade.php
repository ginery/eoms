<x-app-layout>
    <!--begin::Body-->
    <div class="card-body p-0 position-relative overflow-hidden">
        <!--begin::Chart-->
        <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px ; display:none"></div>
        <!--end::Chart-->

        <!--begin::Stats-->
        <div class="card-spacer mt-n20">
            <!--begin::Row-->
            <div class="row m-3" style="flex-wrap: wrap; min-width:50%">
                <!-- Weekly Sales Cards will be inserted here by jQuery -->
                @foreach($documents as $document)
                    <div class="col-md-3 mt-14">
                        <img src="https://images.unsplash.com/photo-1579353977828-2a4eab540b9a?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2FtcGxlfGVufDB8fDB8fHww" alt="Weekly Sales Image" class="col mr-7 mb-7" style="width:100%" onclick="handleCardClick(${week})">
                    </div>
                @endforeach
            </div>
            <!--end::Row-->
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Body-->

    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Define the number of cards you want to generate
            $.ajax({
                url: '/api/documents/get-documents/1', 
                method: 'GET', 
                success: function(data) {
                    console.log("data ni ==========", data)
                }, 
                error: function(error) {
                    console.error('Error fetching products:', error);
                }
            });
        });

        function handleCardClick(index) {
            console.log("card clicked =======", index)
        }

    </script>
</x-app-layout>

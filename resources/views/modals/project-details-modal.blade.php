<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="update-user-form">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Project Details - <span id="project-title">Project Name</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">                    
                    <div class="card-body" style="height: 250px; overflow: auto;">
                        <!--begin::Scroll-->
                        <input type="hidden" id="project_id" />
                        <div class="scroll scroll-pull" id="details-content" data-mobile-height="350">
                            
                            
                        </div>
                        <!--end::Scroll-->
                    </div>            
                </div>
            </div>
        </form>
    </div>
</div>
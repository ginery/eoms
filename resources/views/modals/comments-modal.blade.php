<div class="modal fade" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="update-user-form">
            <div class="modal-content">           
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center flex-grow-1">
                        <div class="text-dark-75 font-weight-bold font-size-h5" id="program_name">Program Name</div>
                        <div>
                            <span class="font-weight-bold text-muted font-size-sm" id="program_date">Date</span>
                        </div>
                    </div>
                    <div class="card-body" style="height: 250px; overflow: auto;">
                        <!--begin::Scroll-->
                        <input type="hidden" id="project_id" />
                        <div class="scroll scroll-pull" id="comment-content" data-mobile-height="350">
                            <!--begin::Messages-->
                            <div class="messages">
                                
                            </div>
                            <!--end::Messages-->
                        </div>
                        <!--end::Scroll-->
                    </div>            
                </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="card-footer align-items-center">
                            <!--begin::Compose-->
                            <textarea class="form-control border-0 p-0" id="comments" rows="2" placeholder="Type a comment"></textarea>
                            <div class="d-flex align-items-center justify-content-between mt-5">                               
                                <div>
                                    <button type="button" onclick="handleSubmitComments()" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
                                </div>
                            </div>
                            <!--begin::Compose-->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
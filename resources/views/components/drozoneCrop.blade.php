


<div class="modal fade" id="modal_{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Crop Image
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="w-100 position-relative" style="height: auto;" id="{{ $id }}_image_wrapper">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" id="crop_{{ $id }}" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>
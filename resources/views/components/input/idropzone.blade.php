<div class="dropzone" id="{{ $id }}"></div>
<input type="hidden" id="{{ $id }}_path" value="{{ $path }}">

<!-- Modal -->
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



<script>
    document.addEventListener("DOMContentLoaded", () => {


        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone("#{{ $id }}", {
            url: "{{ route('dropzone') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ $csrf_token }}'
            },
            type: 'POST',
            parallelUploads: 2,
            acceptedFiles: "{{ $acceptedFiles }}",
            addRemoveLinks: true,
            maxFileSize: 1024 * 1024 * 1024, // 1024mb,
            createImageThumbnails: false,
            chunking: true,
            forceChunking: false,
            retryChunks: true,
            parallelChunkUploads: false,
            chunkSize: 1024 * 1024 * 1, // 1mb
            maxFiles: {{ $limit ?? 'null' }},
            init: function() {
                let existingFiles =
                {!! json_encode($existingFiles) !!}; // Fetch existing files from PHP variable

                // Loop through existing files and add them to Dropzone
                for (let i = 0; i < existingFiles.length; i++) {
                    let file = existingFiles[i];
                    let mockFile = {
                        name: file.name,
                        size: file.size
                    };
                    this.emit("addedfile", mockFile);
                    this.emit("thumbnail", mockFile, file
                    .path); // Assuming you have a path for each file
                    this.emit("complete", mockFile);
                }
                this.on("removedfile", function(file) {
                    $.ajax({
                        url: "{{ route('dropzone.remove') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ $csrf_token }}'
                        },
                        data: {
                            filename: file.name,
                            path: '{{ $path }}'
                        },
                        success: function(response) {
                            console.log('File deleted successfully');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting file:', error);
                        }
                    });
                });
                this.on("sending", function(file, xhr, formData) {
                    formData.append('path', '{{ $path }}')
                });
                this.on('success', function(file){
                    let filename = file.upload.filename;
                    $("#{{ $id }}_image_wrapper").append('<img id="{{ $id }}_image" style="max-width: 100%; display: block;" src="/storage/{{ $path }}/'+filename+'" alt="" />')
                    
                    $('#modal_{{ $id }}').modal('show');
                    
                    $('#modal_{{ $id }}').on('shown.bs.modal', function(){
                        const image = document.getElementById('{{ $id }}_image');
                        const cropper = new Cropper(image, {
                            aspectRatio: 16 / 9,
                            crop(event) {
                            },
                        });

                        

                        
                        function uploadCroppedImage() {
                            cropper.getCroppedCanvas().toBlob((blob) => {
                                const formData = new FormData();

                                formData.append('croppedImage', blob, filename);
                                formData.append('path', '{{ $path }}');
                                formData.append('id', '{{ $id }}');

                                // Send the image to the server using AJAX
                                $.ajax({
                                    url: "{{ route('dropzone.cropped') }}", // Replace with your upload URL
                                    method: 'POST',
                                    data: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ $csrf_token }}'
                                    },
                                    processData: false, // Prevent jQuery from automatically processing the data
                                    contentType: false, // Prevent jQuery from setting the content type
                                    success: function(response) {
                                        console.log('Image uploaded successfully:', response);
                                    },
                                    error: function(error) {
                                        console.error('Image upload failed:', error);
                                    }
                                });
                            });
                        }




                        $('#crop_{{ $id }}').on('click', function(){
                            uploadCroppedImage();
                            $('#modal_{{ $id }}').modal('hide');
                        });

                    });

                    
                })
            }
        });
    });
</script>

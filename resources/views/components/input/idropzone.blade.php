
<div class="dropzone" id="{{ $id }}"></div>
<input type="hidden" id="{{ $id }}_path" value="{{ $path }}">

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
                let existingFiles = {!! json_encode($existingFiles) !!}; // Fetch existing files from PHP variable

                // Loop through existing files and add them to Dropzone
                for (let i = 0; i < existingFiles.length; i++) {
                    let file = existingFiles[i];
                    let mockFile = {
                        name: file.name,
                        size: file.size
                    };
                    this.emit("addedfile", mockFile);
                    this.emit("thumbnail", mockFile, file.path); // Assuming you have a path for each file
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
            }
        });
    });
</script>

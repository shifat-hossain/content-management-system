<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
    $('#summernote').summernote({
        placeholder: 'Write your post content here...',
        height: 300,
        callbacks: {
            onImageUpload: function(files) {
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onMediaDelete: function(target) {
                // alert(target[0].src) 
                deleteImage(target[0].src);
            }
        }
    });

    function uploadImage(file) {
        let data = new FormData();
        data.append("image", file);
        data.append("_token", '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('posts.image_upload') }}",
            method: 'POST',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log(response)
                $('#summernote').summernote('insertImage', response.path);
            },
            error: function(xhr) {
                alert("Image upload failed.");
            }
        });
    }

    function deleteImage(src) {
        console.log(src)
        $.ajax({
            data: {
                _token:'{{ csrf_token() }}',
                src: src
            },
            type: "POST",
            url: "{{ route('posts.unlink_image') }}", // replace with your url
            cache: false,
            success: function(resp) {
                console.log(resp);
            }
        });
    }
</script>

var activate_secret = null;

$(function(){

    var section_upload                                  = $('#avatar-section-upload');
    var section_crop                                    = $('#avatar-section-crop');
    var avatar_img                                      = $('#avatar-img');
    var image                                           = document.getElementById('sample_image');

    var cropper;

    $('#avatar-upload').change(function(event) {

        var files                                       = event.target.files;

        var done = function(url) {

            image.src                                   = url;
            section_crop                                .show();
            section_upload                              .hide();

            cropper = new Cropper(image, {

                aspectRatio:                            1,
                dragMode:                               'move',
                zoomable:                               true,
                zoomOnTouch:                            true,
                viewMode:                               1
            });
        };

        if (files && files.length > 0) {

            reader                                      = new FileReader();

            reader.onload = function(e) {
                done(reader.result);
            };

            reader.readAsDataURL(files[0]);
        }
    });

    $('#avatar-crop-button').click(function() {

        canvas = cropper.getCroppedCanvas({
            minWidth: 256,
            minHeight: 256,
            maxWidth: 1024,
            maxHeight: 1024,
        });

        canvas.toBlob(function(blob) {

            url                                         = URL.createObjectURL(blob);
            var reader                                  = new FileReader();
            reader                                      .readAsDataURL(blob);

            reader.onloadend = function() {

                var base64data                          = reader.result;

                $.ajax({
                    url:                                '/submit/avatar',
                    method:                             'POST',
                    data: {
                        user:                           user,
                        image:                          base64data,
                        activate_secret:                activate_secret
                    },
                    success:
                        function(result) {

                            avatar_img                  .attr("src", "/storage/avatar/" + result.file_name);
                            avatar_img                  .removeClass(ATTR_INVISIBLE);
                            section_crop                .hide();
                            section_upload              .show();

                            cropper.destroy();
                            document.getElementById("avatar-form").reset();
                        }
                });
            };
        }, 'image/png', 1);
    })
});

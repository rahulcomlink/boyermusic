$(function() {
	"use strict";

    $('#fancy-file-upload').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 1000000
    });

    $('#fancy-file-upload input[type="file"]').on('change', function() {
        // Get the number of selected files
        var numberOfFiles = $(this)[0].files.length;

        // Check if the number of files exceeds 5
        if (numberOfFiles > 5) {
            alert('You can upload a maximum of 5 images.');
            // Clear the file input to prevent uploading
            $(this).val('');
        }
    });


    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })
});
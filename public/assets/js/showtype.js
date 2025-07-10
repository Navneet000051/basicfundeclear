//Form VAlidation JS **************************************************************************************************

$(document).ready(function() {
    $('.dropify').dropify();

// Check if default file is set for thumbnail input
var defaultThumbnail = $('.dropify').data('default-file');
    $('#addForm').validate({
        ignore: 'hidden',
        rules: {
            title: {
                required: true
            },
            subtitle: {
                required: true
            },

            // description: {
            //     required: true
            // },
            // metatitle: {
            //     required: true
            // },
            // metakey: {
            //     required: true
            // },
            // metadescription: {
            //     required: true
            // },
            thumbnail: { // Add validation rules for thumbnail
            required: !defaultThumbnail, // Make it required
        }

        },
        messages: {
            title: {
                required: "Please enter title",
               
            },
            subtitle: {
                required: "Please enter subtitle",
               
            },

            // description: {
            //     required: "Please enter description"
            // },
            // metatitle: {
            //     required: "Please enter metatitle"
            // },
            // metakey: {
            //     required: "Please enter metakey"
            // },
            // metadescription: {
            //     required: "Please enter metadescription"
            // },
            thumbnail: {
            required: "Please select thumbnail",
           
        }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            if (element.attr("name") == "userid" || "month") {
                error.addClass('text-danger');
                error.insertAfter(element.parent());
            } else {
                error.addClass('text-danger');
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid mb-1');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid mb-1');
        }
    });
    // Custom validation for Summernote description

});
 // Listen for Dropify file drop
// $('.dropify').on('dropify.afterDrop', function() {
//     $('#thumbnail-error').addClass('d-none'); // Hide the error message
// });
$('.dropify').on('change', function() {
if ($(this).dropify('hasFile')) {
    $('#thumbnail-error').hide(); // Hide the error message
} else {
    $('#thumbnail-error').show(); // Show the error message if no file is uploaded
}
});

// Listen for Dropify file clear
$('.dropify').on('dropify.afterClear', function() {
$('#thumbnail-error').show(); // Show the error message
});
// --- tagify validation-------------------------------------------------------
                                        // ==========================================

// $('#addForm').submit(function(event) {
//     // Check if the form has validation errors
//     if (!this.checkValidity()) {
     
//         event.preventDefault();
//         event.stopPropagation();

//         // Get the number of tags inside the Tagify input
//         var numTags = $('.tagify__tag').length;

//         // Check if there are no tags present
//         if (numTags === 0) {
//             // Add a class to the Tagify component
//             $('.metakey').addClass('is-invalid-tagify');
//         }
//     }
// });





// $('.tagify__input').on('input', function() {
//     // alert(1)
//     // Remove the class when user starts typing in the metakey field
//     $('.tagify').removeClass('is-invalid-tagify');
//     $('#metakey-error').addClass('d-none');
// });

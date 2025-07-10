$(document).ready(function() {
//Tagify Js code ********************
 // The DOM element you wish to replace with Tagify
 var input = document.querySelector('input[name=metakey]');

 // initialize Tagify on the above input node reference
 new Tagify(input)

    // Form-validation *****************************
    $('.dropify').dropify();

    // Check if default file is set for thumbnail input
    var defaultThumbnail = $('.dropify').data('default-file');
    $('#addForm').validate({
        ignore: 'hidden',
        rules: {
            showtype_id: {
                required: true
            },
            title: {
                required: true
            },
            subtitle: {
                required: true
            },
            url: {
                required: true,
                url: true
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
            showtype_id: {
                required: "Please select project type"
            },
            title: {
                required: "Please enter title"
            },
            subtitle: {
                required: "Please enter subtitle"
            },
            url: {
                required: "Please enter  url",
                url: "Please enter valid url"
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
// ------------------------ Tagify Validation ---------------------------
// $('#addForm').submit(function(event) {
//     // Check if the form has validation errors
//     if (!this.checkValidity()) {
//         // If there are validation errors, prevent the form from submitting
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

//tagify ****************************************************************************
   // The DOM element you wish to replace with Tagify
   var input = document.querySelector('input[name=metakey]');
   var input2 = document.querySelector('input[name=attribute]');

   // initialize Tagify on the above input node reference
   new Tagify(input)
   new Tagify(input2)

   //form-validation ***************************************************************************************************

   $(document).ready(function() {
    // $('.dropify').dropify();

    // Check if default file is set for thumbnail input
    var defaultThumbnail = $('.dropify').data('default-file');
    $('#addForm').validate({
        ignore: 'hidden',
        rules: {
            subheading: {
                required: true
            },
            heading: {
                required: true
            },
            attribute: {
                required: true
            },
            watchlink: {
                required: true,
                url: true
            },

            description: {
                required: true
            },
            metatitle: {
                required: true
            },
            metakey: {
                required: true
            },
            metadescription: {
                required: true
            },
            // content: { // Add validation rules for thumbnail
            //     required: true, // Make it required
            // }

        },
        messages: {
            heading: {
                required: "Please enter heading",

            },
            subheading: {
                required: "Please enter subheading",

            },

            attribute: {
                required: "Please enter attribute",

            },
            watchlink: {
                required: "Please enter url",
                url: "Please enter a url"
            },

            description: {
                required: "Please enter description"
            },
            metatitle: {
                required: "Please enter metatitle"
            },
            metakey: {
                required: "Please enter metakey"
            },
            metadescription: {
                required: "Please enter metadescription"
            },
            // content: {
            //     required: "Please select a file",

            // }
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

// -------------------------- Tagify validation ------------------------------



$('#addForm').submit(function(event) {
    // Check if the form has validation errors
    if (!this.checkValidity()) {
        // If there are validation errors, prevent the form from submitting
        event.preventDefault();
        event.stopPropagation();

        // Get the number of tags inside the Tagify input
        var keynumTags = $('.metakey .tagify__tag').length;

        // Check if there are no tags present
        if (keynumTags === 0) {
            // Add a class to the Tagify component
            $('.metakey').addClass('is-invalid-tagify');
        }
        // Get the number of tags inside the Tagify input
        var attributenumTags = $('.attribute .tagify__tag').length;

        // Check if there are no tags present
        if (attributenumTags === 0) {
            // Add a class to the Tagify component
            $('.attribute').addClass('is-invalid-tagify');
        }
    }
});


// Listen for input events on both Tagify inputs
$('.metakey .tagify__input').on('input', function() {
    // Remove the class when the user starts typing in the metakey field
    $('.metakey').removeClass('is-invalid-tagify');
    $('#metakey-error').addClass('d-none');
});

$('.attribute .tagify__input').on('input', function() {
    // Remove the class when the user starts typing in the attribute field
    $('.attribute').removeClass('is-invalid-tagify');
    $('#attribute-error').addClass('d-none');
});
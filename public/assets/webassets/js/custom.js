
// $('#contactForm').on('submit', function(e) {
//     e.preventDefault();
//     var data = new FormData(this);
//     var formAction = $(this);
//     var btnAction = $('#ContactBtn');
//     var spinAction = $('#contactSpin');

//     if ($(formAction).parsley().isValid() == true) {
//         $.ajax({
//             type: 'POST',
//             url: $(formAction).attr('action'),
//             data: data,
//             cache: false,
//             contentType: false,
//             processData: false,
//             beforeSend: function() {
//                 $(btnAction).attr("disabled", true);
//                 $(spinAction).show();
//             },
//             success: function(res) {
//                 $(btnAction).removeAttr("disabled");
//                 $(spinAction).hide();
//                 console.log(res);
//                 if ($.trim(res) == 'success') {
//                     $('#contactForm')[0].reset();

//                     $('#enqmsg').css('display', 'block');

//                     window.setTimeout(function() {
//                         $('#enqmsg').css('display', 'none');
//                     }, 3000);
//                 } else if ($.trim(res) == 'error') {
//                     $.notify("Data Not Submitted", "error");
//                 } else {
//                     console.log("Unexpected response:", res);
//                 }

//             },
//             error: function() {
             
//             }
//         });
//     }
// });
// Contact form submission with AJAX and rate-limit handling
$('#contactForm').on('submit', function(e) {
    e.preventDefault();
    
    var data = new FormData(this);
    var formAction = $(this);
    var btnAction = $('#ContactBtn');
    var spinAction = $('#contactSpin');

    // Hide both messages initially
    $('#enqmsg').hide();
    $('#enqerror').hide();

    if ($(formAction).parsley().isValid() === true) {
        $.ajax({
            type: 'POST',
            url: $(formAction).attr('action'),
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(btnAction).attr("disabled", true);
                $(spinAction).show();
            },
            success: function(res) {
                $(btnAction).removeAttr("disabled");
                $(spinAction).hide();
                console.log(res);

                if ($.trim(res) === 'success') {
                    $('#contactForm')[0].reset();

                    $('#enqmsg').html('<span style="color:#3c763d;line-height:40px;font-size:15px;">&nbsp;&nbsp;Thank you for your enquiry.</span>').show();

                    setTimeout(function() {
                        $('#enqmsg').fadeOut();
                    }, 4000);
                } else {
                    $('#enqerror').html('<span style="color:#3c763d;line-height:40px;font-size:15px;">&nbsp;&nbsp;Failed to send email. Please try again.</span>').show();

                    setTimeout(function() {
                        $('#enqerror').fadeOut();
                    }, 4000);
                }
            },
            error: function(xhr, status, error) {
                $(btnAction).removeAttr("disabled");
                $(spinAction).hide();

                if (xhr.status === 429) {
                    // Too many requests
                    $('#enqerror').html('<span style="color:#3c763d;line-height:40px;font-size:15px; width:250px;">&nbsp;&nbsp;You are sending too many requests.</span>').show();
                } else {
                    // Other error
                    $('#enqerror').html('<span style="color:#3c763d;line-height:40px;font-size:15px;">&nbsp;&nbsp;Something went wrong. Please try again later.</span>').show();
                }

                setTimeout(function() {
                    $('#enqerror').fadeOut();
                }, 5000);
            }
        });
    }
});

$('#rentenquiryForm').on('submit', function(e) {
    e.preventDefault();
    
    var data = new FormData(this);
    var formAction = $(this);
    var btnAction = $('#ContactBtn');
    var spinAction = $('#contactSpin');

    // Hide both messages initially
    $('#enqmsg').hide();
    $('#enqerror').hide();

    if ($(formAction).parsley().isValid() === true) {
        $.ajax({
            type: 'POST',
            url: $(formAction).attr('action'),
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(btnAction).attr("disabled", true);
                $(spinAction).show();
            },
            success: function(res) {
                $(btnAction).removeAttr("disabled");
                $(spinAction).hide();
                console.log(res);

                if ($.trim(res) === 'success') {
                    $('#rentenquiryForm')[0].reset();

                    $('#enqmsg').html('<span style="color:#3c763d;line-height:40px;font-size:15px;">&nbsp;&nbsp;Thank you for your enquiry.</span>').show();

                    setTimeout(function() {
                        $('#enqmsg').fadeOut();
                    }, 4000);
                } else {
                    $('#enqerror').html('<span style="color:#3c763d;line-height:40px;font-size:15px;">&nbsp;&nbsp;Failed to send email. Please try again.</span>').show();

                    setTimeout(function() {
                        $('#enqerror').fadeOut();
                    }, 4000);
                }
            },
            error: function(xhr, status, error) {
                $(btnAction).removeAttr("disabled");
                $(spinAction).hide();

                if (xhr.status === 429) {
                    // Too many requests
                    $('#enqerror').html('<span style="color:#3c763d;line-height:40px;font-size:15px; width:250px;">&nbsp;&nbsp;You are sending too many requests.</span>').show();
                } else {
                    // Other error
                    $('#enqerror').html('<span style="color:#3c763d;line-height:40px;font-size:15px;">&nbsp;&nbsp;Something went wrong. Please try again later.</span>').show();
                }

                setTimeout(function() {
                    $('#enqerror').fadeOut();
                }, 5000);
            }
        });
    }
});

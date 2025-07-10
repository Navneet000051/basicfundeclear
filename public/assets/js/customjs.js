//ck editor ********************
ClassicEditor
.create(document.querySelector('#editor'))
.then(editor => {
    console.log(editor);
})
.catch(error => {
    console.error(error);
});


// //Summernote ***************************************************************************
//     $(document).ready(function() {
//         $('.summernote').summernote({
//             tabsize: 2,
//             height: 100,
//             toolbar: [
//           ['style', ['style']],
//           ['font', ['bold', 'underline', 'clear']],
//           ['color', ['color']],
//           ['para', ['ul', 'ol', 'paragraph']],
//           ['table', ['table']],
//           ['insert', ['link', 'picture', 'video']],
//           ['view', ['fullscreen', 'codeview', 'help']]
//         //   ['view', ['fullscreen', 'codeview', 'help']]
//         ]
            
//         });
//         // $(".note-editable").attr("contenteditable", "false");
//     });

//     //Datetime ************************************************************************************
//     $('#datetime-s').datetimepicker({
//         sideBySide: true,
//         format: 'YYYY-MM-DD hh:mm A',
//         widgetPositioning: {
//             horizontal: 'auto',
//             vertical: 'bottom'
//         }
//     }).on('dp.change', function(e) {
//         // Set the minimum date for datetime-e when datetime-s changes
//         $('#datetime-e').data('DateTimePicker').minDate(e.date);
//     });

//     $('#datetime-e').datetimepicker({
//         sideBySide: true,
//         format: 'YYYY-MM-DD hh:mm A',
//         widgetPositioning: {
//             horizontal: 'auto',
//             vertical: 'bottom'
//         }
//     });

// //whitespace validation ****************************************************************

//     $('input').keypress(function(e) {
//             if (this.value.length === 0 && e.which === 32) e.preventDefault();
//         });
//         $('textarea').keypress(function(e) {
//             if (this.value.length === 0 && e.which === 32) e.preventDefault();
//         });
//         $('input[name="mobile"]').on('input', function() {
//             $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
//             if ($(this).val().length > 10) {
//                 $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
//             }
//         });


//         $('input[name="section"]').on('input', function() {
//             $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
//             if ($(this).val().length > 10) {
//                 $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
//             }
//         });




// form-validation.js
document.addEventListener('DOMContentLoaded', function() {
    $('form').parsley();
    $('#email, #username, #message').keypress(function(e) {
        if (this.value.length === 0 && e.which === 32) e.preventDefault();
    });
});


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register | Basic Funde Clear</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BFC CMS" name="description" />
    <meta content="bfc" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/logo.png') }}">



    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css1-->
    <link href="{{ asset('assets/css/css1.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css2-->
    <link href="{{ asset('assets/css/css2.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Toastr Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}">

</head>

<body class="auth-body-bg">
    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-4">
                    <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                        <div class="w-100">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div>
                                        <div class="text-center">
                                            <div>
                                                <a href="index.html" class="authentication-logo">
                                                    <img src="{{ asset('assets/admin/logo.png') }}" alt="" height="50" class="auth-logo logo-dark mx-auto">
                                                    <img src="{{ asset('assets/admin/logo.png') }}" alt="" height="50" class="auth-logo logo-light mx-auto">
                                                </a>
                                            </div>
                                            <h4 class="font-size-18 mt-2">Register account</h4>
                                            <p class="text-muted">Get your free BFC account now.</p>
                                        </div>

                                        <div class="p-2 mt-3">
                                            <form class="" action="{{ route('admin.registrationdata') }}" method="POST">
                                                @csrf

                                                <div class="auth-form-group-custom mb-4">
                                                    <i class="ri-user-line auti-custom-input-icon"></i>
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="auth-form-group-custom mb-4">
                                                    <i class="ri-mail-line auti-custom-input-icon"></i>
                                                    <label for="useremail">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" name="email" placeholder="Enter email" value="{{ old('email') }}">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="auth-form-group-custom mb-4">
                                                    <i class="ri-phone-line auti-custom-input-icon"></i>
                                                    <label for="mobile">Mobile</label>
                                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Enter Mobile Number" value="{{ old('mobile') }}">
                                                    @error('mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="auth-form-group-custom mb-4">
                                                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password" placeholder="Enter password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="text-center">
                                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">By registering you agree to the Basic Funde Clear <a href="#" class="text-primary">Terms of Use</a></p>
                                                </div>
                                            </form>

                                        </div>

                                        <!-- <div class="mt-5 text-center">
                                                <p>Already have an account ? <a href="auth-login.html" class="fw-medium text-primary"> Login</a> </p>
                                                <p>© <script>document.write(new Date().getFullYear())</script> Nazox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
                                            </div> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="authentication-bg position-relative">
                        <div class="bg-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- toastr plugin -->
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js')}}"></script>

    <!-- toastr init -->
    <script src="{{ asset('assets/js/pages/toastr.init.js')}}"></script>
    <!-- Valiation CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('input').keypress(function(e) {
            if (this.value.length === 0 && e.which === 32) e.preventDefault();
        });
        $('textarea').keypress(function(e) {
            if (this.value.length === 0 && e.which === 32) e.preventDefault();
        });
        $('input[name="mobile"]').on('input', function() {
            $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
            if ($(this).val().length > 10) {
                $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
            }
        });
        $('form').validate({

            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                password: {
                    required: true,
                    minlength: 5,
                    password: true

                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {

                error.addClass('text-danger');
                error.insertAfter(element);

            },
            highlight: function(element) {
                $(element).addClass('is-invalid mb-1');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid mb-1');
            }
        });
    </script>

    
    <!-- toastr init -->
    <script>
@if(Session::has('message'))
    var messageType = '{{ Session::get("status") }}';
    var message = '{{ Session::get("message") }}';
    
    toastr[messageType](message, '', {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    });
    @endif
    
    
    @if(Session::has('success'))
        toastr.success('{{ Session::get("success") }}', '', {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
        @endif
       
        
        @if(Session::has('error'))
        toastr.error('{{ Session::get("error") }}', '', {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
        @endif 
      
    </script>



</body>

</html>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | BFC - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Basic funde clear" name="description" />
    <meta content="Content Management System" name="author" />
    <!-- App favicon -->
   <link rel="shortcut icon" href="{{asset('assets/webassets/img/favicon.png')}}">



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
                <div class="col-lg-4" style="background: linear-gradient(to bottom right, #fbcfe8, #dbeafe, #fef9c3);">
                    <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                        <div class="w-100">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div>
                                        <div class="text-center">
                                            <div>
                                                <a href="index.html" class="authentication-logo">
                                                    <img src="{{ asset('assets/admin/favicon.png') }}" alt="" height="80" class="auth-logo logo-dark mx-auto">
                                                    <img src="{{ asset('assets/admin/favicon.png') }}" alt="" height="80" class="auth-logo logo-light mx-auto">
                                                </a>
                                            </div>

                                            <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                            <p class="text-muted">Sign in to continue to BFC Softtech.</p>
                                        </div>

                                        <div class="p-2 mt-5">
                                            @php
                                            $request = Request::capture();
                                            $uri = $request->path();

                                            // If you want to get only the last segment of the URI (after the last "/")
                                            $uriName = last(explode('/', $uri));

                                            @endphp
                                            <!-- $uriName.'.logindata -->
                                            <form class="" action="{{route('admin.logindata')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3 auth-form-group-custom mb-4">
                                                    <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                    <label for="username" class="fw-semibold">Username</label>
                                                    <input type="text" class="form-control" id="username" name="email" placeholder="Enter username" value="{{old('email')}}">
                                                    <span class="text-danger">
                                                        @error('email')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-3 auth-form-group-custom mb-4">
                                                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                                    <span class="text-danger">
                                                        @error('password')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>


                                                <div class="mt-4 text-center">
                                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                                </div>

                                                <!-- <div class="mt-4 text-center">
                                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                                    </div> -->
                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
          
                                            <p>© <script>
                                                    document.write(new Date().getFullYear())
                                                </script> BFC. Crafted with <i class="mdi mdi-heart text-danger"></i> by BFC Softtech</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="authentication-bg">
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
    <!--- Validation CDN --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- toastr init -->
    <script src="{{ asset('assets/js/pages/toastr.init.js')}}"></script>
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
                email: {
                    required: true,
                    email: true
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
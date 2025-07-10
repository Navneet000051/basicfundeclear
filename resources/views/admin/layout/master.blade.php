<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ !empty($title) ? $title : 'Basic Funde Clear' }} | BFC SOFTTECH Content Managment System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Besic Funde Clear" name="description" />
    <meta content="CMS" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Include CSRF token meta tag -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/webassets/img/favicon.png')}}">


    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- select2 Css -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
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
    <!--summernote css-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" /> -->
    <!-- datatable --->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App favicon -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover.css" integrity="sha512-Qg72y9f1a3aVc1FVnjq5YURLOOG8fDKQjMnhxYaZgBz4nIVjpVOBUtuMMMqkZPS1FlVrzzEBXq2sM6Qp1zen/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!--TimePicker-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.1/jquery.timepicker.min.css" integrity="sha512-WlaNl0+Upj44uL9cq9cgIWSobsjEOD1H7GK1Ny1gmwl43sO0QAUxVpvX2x+5iQz/C60J3+bM7V07aC/CNWt/Yw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Dropify css -->
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

    <!-- Tagify Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.26.3/tagify.css" integrity="sha512-ZMGRhlU3S8DU8D/kpefGIIebVOyAiTk5xOkM6YGiDJYKlHzYePf+uTNkkyf/jnamBK4SBxT1kmp2LniCXa8Z2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
    .table th {
        background-color: #212529;
        color: #fff;
    }

    table.table-bordered.dataTable tbody td {
        border-bottom-width: 1px;
    }

    .dropify-wrapper .dropify-message span.file-icon {
        font-size: 20px;
        color: #CCC;
    }

    .dropify-wrapper {
        display: block;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        width: 100%;
        max-width: 100%;
        height: 120px;
        padding: 5px 10px;
        font-size: 14px;
        line-height: 22px;
        color: #777;
        background-color: #FFF;
        background-image: none;
        text-align: center;
        border: 2px solid #E5E5E5;
        -webkit-transition: border-color .15s linear;
        transition: border-color .15s linear;
    }
</style>

<body data-sidebar="dark" style="background: linear-gradient(to bottom right, #fbcfe8, #dbeafe, #fef9c3);">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{asset('assets/webassets/img/favicon.png')}}" alt="logo-sm-dark" height="25">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admin/logo.png') }}" alt="logo-dark" height="40">
                            </span>
                        </a>

                        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admin/favicon.png') }}" alt="logo-sm-light" height="25">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admin/favicon.png') }}" alt="logo-light" height="40"> <span style='color:#fff !important;font-family: "Lobster", sans-serif;
  font-weight: 100;
  font-style: normal;font-size:20px;'>Basic Funde Clear</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="ri-search-line"></span>
                        </div>
                    </form>


                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="mb-3 m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-notification-3-line"></i>
                            <span class="noti-dot"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="ri-shopping-cart-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-1">Test Notification</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">This is Test Notification</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>



                            </div>
                            <div class="p-2 border-top">
                                <div class="d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <a href="{{ !empty(auth()->user()->icon) ? Storage::disk('s3')->url(auth()->user()->icon) : asset('assets/images/user.jpg') }}" target="_blank"> <img class="rounded-circle header-profile-user" src="{{ !empty(auth()->user()->icon) ? Storage::disk('s3')->url(auth()->user()->icon) : asset('assets/images/user.jpg') }}" alt=""></a>
                            <span class="d-none d-xl-inline-block ms-1">{{ auth()->user()->name}}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ route('admin.adminprofile') }}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                            <a class="dropdown-item" href="{{ route('admin.changePassword') }}"><i class="ri-lock-unlock-line align-middle me-1"></i> Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#top-modal"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="ri-settings-2-line"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>
        <!-- Logout modal content -->
        <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-top  modal-sm">
                <div class="modal-content">

                    <div class="modal-body">
                        <h4 class="modal-title" id="topModalLabel">Logout {{config('app.name')}}</h4>
                        <p class="mb-0">Would you like to logout?</p>
                    </div>
                    <div class="modal-footer">
                        <a data-bs-dismiss="modal" class="btn btn-secondary btn-sm">NO</button>
                            <a href="{{route('admin.logout')}}" class="btn btn-primary btn-sm">YES</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!-- /.modal -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                <i class="ri-dashboard-line"></i>
                                <!-- <span class="badge rounded-pill bg-success float-end">3</span> -->
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.contact') }}" class=" waves-effect">
                                <i class="ri-pencil-ruler-2-line"></i>
                                <span>Manage Contact</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.indexcontent') }}" class=" waves-effect">
                                <i class="ri-stack-line"></i>
                                <span>Manage Index Content</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.aboutcontent') }}" class=" waves-effect">
                                <i class="ri-store-2-line"></i>
                                <span>Manage About Content</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.shorts') }}" class=" waves-effect">
                                <i class="ri-profile-line"></i>
                                <span>Manage Shorts</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.teammember') }}" class=" waves-effect">
                                <i class="fa fa-users"></i>
                                <span>Manage Team</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.heading') }}" class=" waves-effect">
                                <i class="ri-table-2"></i>
                                <span>Manage Section Heading</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.rentstudio') }}" class=" waves-effect">
                                <i class="ri-vidicon-2-fill"></i>
                                <span>Manage Rent Studio</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.rentenquirydetails') }}" class=" waves-effect">
                              <i class="ri-bar-chart-line"></i>
                                <span>Manage Rent Enquiry</span>
                            </a>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-layout-3-line"></i>
                                <span>Manage Show</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('admin.show') }}">Show</a></li>
                                <li><a href="{{ route('admin.showtype') }}">Show Type</a></li>
                                <li><a href="{{ route('admin.showassign') }}">Show Assign</a></li>

                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        @yield('content')
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Basic Funde Clear.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by Team Softtech
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="{{ asset('assets/images/layouts/layout-1.jpg') }}" class="img-fluid img-thumbnail" alt="layout-1">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="{{ asset('assets/images/layouts/layout-2.jpg') }}" class="img-fluid img-thumbnail" alt="layout-2">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="{{ asset('assets/css/bootstrap-dark.min.css') }}" data-appStyle="{{ asset('assets/css/app-dark.min.css') }}">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>




            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>



    <!-- JAVASCRIPT -->

    <script>
        var bootstrapCssUrl = "{{ asset('assets/css/bootstrap.min.css') }}";
        var appCssUrl = "{{ asset('assets/css/app.min.css') }}";
        var bootstrapRtlCssUrl = "{{ asset('assets/css/bootstrap-rtl.min.css') }}";
        var appRtlCssUrl = "{{ asset('assets/css/app-rtl.min.css') }}";
    </script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <!-- Ajax Request -->
    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    </script>
    <!--datatable cdn-->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script src="{{ asset('assets/js/app.js') }}"></script>


    <!-- jquery.vectormap map -->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

    <!-- Dropify Js -->
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                showErrors: true,
                errorTimeout: 3000,
                errorsPosition: 'overlay',
                // Include WEBP in allowed extensions
                imgFileExtensions: ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp', 'mp4'],
                maxFileSizePreview: "5M",
                allowedFormats: ['portrait', 'square', 'landscape'],
                allowedFileExtensions: ['*'],
            });
        });
    </script>
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!--Parsley Js --->
    <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>

    <!-- toastr plugin -->
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js')}}"></script>

    <!-- toastr init -->
    <script src="{{ asset('assets/js/pages/toastr.init.js') }}"></script>
    <!-- Valiation CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Select Js -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>

    <!--- Tagify Js--->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.26.3/tagify.js" integrity="sha512-Kw7ytRYA3AmEaBS8e8DLbVPFU0zBUSrll3d2+BymmQWz//HBPuqwxFVc0bAvhmTTKSLSUGowWrjtCfBdGQ49VQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery UI Sortable -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!---Make the table rows sortable -->
    @isset($tablename)
    <script>
        $(document).ready(function() {
            // Make the table rows sortable
            $("#yajradb tbody").sortable({
                axis: "y", // Allow dragging only vertically
                cursor: "move", // Set cursor style to indicate draggable elements
                update: function(event, ui) {
                    // Get the new order of the rows
                    var newOrder = $(this).sortable('toArray', {
                        attribute: 'data-id'
                    });

                    // Perform AJAX call to update the database
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var tablename = "{{ $tablename }}";
                    $.ajax({
                        url: "{{ route('admin.updatePositions') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            newOrder: newOrder,
                            tablename: tablename
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }).disableSelection(); // Prevent text selection while dragging
        });
    </script>
    @endisset


    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js" integrity="sha512-ZESy0bnJYbtgTNGlAD+C2hIZCt4jKGF41T5jZnIXy4oP8CQqcrBGWyxNP16z70z/5Xy6TS/nUZ026WmvOcjNIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                    //   ['view', ['fullscreen', 'codeview', 'help']]
                ]

            });
            // $(".note-editable").attr("contenteditable", "false");
        });
    </script>
    <!-- whitespace validation--->

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


        $('input[name="section"]').on('input', function() {
            $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
            if ($(this).val().length > 10) {
                $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
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

    <!--- Change status -->
    <script>
        function changeStatus(where_id, where_id_value, where_column, where_column_value, where_table) {

            // $('.table').html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ route('admin.changeStatus') }}", // Replace with your Laravel route
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "where_id": where_id,
                    "where_id_value": where_id_value,
                    "where_column": where_column,
                    "where_column_value": where_column_value,
                    "where_table": where_table,
                },
                success: function(data) {
                    if (data.status === 'success') {
                        // Display success message using Toastr
                        toastr.success('Update successful');

                        // Reload the page after a delay
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        // Display error message using Toastr
                        toastr.error('Error: ' + data.message);
                    }
                },
                error: function(error) {
                    // Display generic error message using Toastr
                    toastr.error('An error occurred');
                }
            });
        }
    </script>


    <!-- Timepeacker JS-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        $('#datetime-s').datetimepicker({
            sideBySide: true,
            format: 'YYYY-MM-DD hh:mm A',
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            }
        }).on('dp.change', function(e) {
            // Set the minimum date for datetime-e when datetime-s changes
            $('#datetime-e').data('DateTimePicker').minDate(e.date);
        });

        $('#datetime-e').datetimepicker({
            sideBySide: true,
            format: 'YYYY-MM-DD hh:mm A',
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });
    </script>
    <!--- Delete model--->
    <script>
        function deleteData(where_column, where_id, where_table) {
            $('#delete_modal').modal('show');
            $('#delColumn').val(where_column);
            $('#delId').val(where_id);
            $('#delTable').val(where_table);
        }
    </script>

    <!--- Change Publication status -->
    <script>
        function changePublicationStatus(where_id, where_id_value, where_column, where_column_value, where_table) {

            // $('.table').html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ route('admin.changePublicationStatus') }}", // Replace with your Laravel route
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "where_id": where_id,
                    "where_id_value": where_id_value,
                    "where_column": where_column,
                    "where_column_value": where_column_value,
                    "where_table": where_table,
                },
                success: function(data) {
                    if (data.status === 'success') {
                        // Display success message using Toastr
                        toastr.success('Update successful');

                        // Reload the page after a delay
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        // Display error message using Toastr
                        toastr.error('Error: ' + data.message);
                    }
                },
                error: function(error) {
                    // Display generic error message using Toastr
                    toastr.error('An error occurred');
                }
            });
        }
    </script>
    @yield('externaljs')
</body>

</html>
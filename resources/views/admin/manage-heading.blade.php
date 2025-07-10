@extends('admin.layout.master')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        @if(!empty($editcontact))
                        <h4 class="mb-sm-0">Edit Heading</h4>
                        <a href="{{route('admin.heading')}}">
                            <button class="btn btn-primary">Add Heading</button>
                        </a>
                        @else
                        <h4 class="mb-sm-0">Heading</h4>
                        @endif
                    </div>

                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" id="addForm" action="{{ route('admin.addheading') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 mt-1">
                                        <div class="row">
                                            
                                        <input type="hidden" class="form-control" name="id" value="{{ old('id', !empty($editcontact) ? $editcontact->id : '') }}">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Heading<span class="text-danger fw-bold">*</span></label>
                                                    <input type="text" class="form-control" name="heading" value="{{ old('heading', !empty($editcontact) ? $editcontact->heading : '') }}">
                                                    @error('heading')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-12 mt-1">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label font-weight-600">Subheading <span class="text-danger fw-bold">*</span></label>
                                                    <textarea class="form-control summernote" name="subheading" id="description" required>{{ old('subheading', !empty($editcontact) ? $editcontact->subheading : '') }}</textarea>
                                                    @error('subheading')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row m-2">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="mt-3 btn btn-primary p-2 form-btn" id="videoBtn">SAVE <i class="fa fa-spin fa-spinner" id="videoSpin" style="display:none;"></i></button>
                                                <a href="{{ route('admin.show') }}"><button class="mt-3 btn btn-danger p-2 form-btn" id=""><a class="text-white" href="{{ route('admin.show') }}">Cancel</a></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
                <!--- Table Section --->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive m-2">

                                    <table id="yajradb" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead id="sortable">
                                            <tr>
                                                <th>SR. NO.</th>
                                                <th>Heading</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- Delete Client Modal -->

        <div class="col-sm-6 col-md-4 col-xl-3">

            <div class="modal fade bs-example-modal-center" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-body text-center m-2">
                            <div class="form-header ">
                                <h3>Delete Data</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <form action="{{route('admin.DeleteData')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row">

                                        <div class="col-6">
                                            <input type="hidden" name="Id" id="delId" />
                                            <input type="hidden" name="column" id="delColumn" />
                                            <input type="hidden" name="table" id="delTable" />
                                            <input type="submit" value="Delete" class="btn btn-outline-success btn-rounded waves-effect waves-light w-100 fw-bolder">
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-outline-danger btn-rounded waves-effect waves-light w-100 fw-bolder" data-bs-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal -->

        <!-- /Delete Client Modal -->
    </div>

    @endsection
    @section('externaljs')

    <script>
        // The DOM element you wish to replace with Tagify
        var input = document.querySelector('input[name=metakey]');

        // initialize Tagify on the above input node reference
        new Tagify(input)
    </script>

    <script>
        $(document).ready(function() {
            // $('.dropify').dropify();

            // Check if default file is set for thumbnail input
            var defaultThumbnail = $('.dropify').data('default-file');
            $('#addForm').validate({
                ignore: 'hidden',
                rules: {

                    heading: {
                        required: true
                    },
                    subheading: {
                        required: true
                    },
                    
                    // thumbnail: { // Add validation rules for thumbnail
                    //     required: !defaultThumbnail, // Make it required
                    // }

                },
                messages: {
                    heading: {
                        required: "Please enter heading",
                    },

                    subheading: {
                        required: "Please enter subheading"
                    },
                  
                  
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
           

        });

        // -------------------------- Tagify validation ------------------------------
  
        // $('.dropify').on('change', function() {
        //     if ($(this).dropify('hasFile')) {
        //         $('#thumbnail-error').hide(); // Hide the error message
        //     } else {
        //         $('#thumbnail-error').show(); // Show the error message if no file is uploaded
        //     }
        // });

        // // Listen for Dropify file clear
        // $('.dropify').on('dropify.afterClear', function() {
        //     $('#thumbnail-error').show(); // Show the error message
        // });


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
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                var table = $('#yajradb').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.heading') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'heading',
                            name: 'heading'
                        },
                     
                       
                        {
                            data: 'status',
                            name: 'status'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ],
                    "pageLength": 150, // Set the default page length to 50
            "lengthMenu": [ [10, 25, 50, 100, 150, 200], [10, 25, 50, 100, 150, 200] ] // Length menu options
                });



            });

        });
    </script>
    @endsection
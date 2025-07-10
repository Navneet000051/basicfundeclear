@extends('admin.layout.master')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        @if(!empty($editshow))
                        <h4 class="mb-sm-0">Edit Show Type</h4>
                        <a href="{{route('admin.showtype')}}">
                            <button class="btn btn-primary">Add Show Type</button>
                        </a>
                        @else
                        <h4 class="mb-sm-0">Show Type</h4>
                        @endif
                    </div>

                </div>
            </div>
           
            <!-- end page title -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        <form method="post" id="addForm" action="{{ route('admin.addshowtype') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 mt-1">
                                        <div class="row">
                                            

                                            <div class="col-sm-6 mt-1">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="hidden" class="form-control" name="id" value="{{ old('id', !empty($editshow) ? $editshow->id : '') }}">
                                               <div class="form-group">
                                                    <label class="control-label font-weight-600">Title <span class="text-danger fw-bold">*</span></label>
                                                    <input type="text" class="form-control" name="title" value="{{ old('title', !empty($editshow) ? $editshow->title : '') }}" required>
                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-3">
                                            <div class="form-group">
                                                    <label>Subtitle <span class="text-danger fw-bold">*</span></label>
                                                    <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle', !empty($editshow) ? $editshow->subtitle : '') }}">
                                                    @error('subtitle')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mt-1">
                                        <div class="row">
                                            <div class="col-sm-12 mt-1">
                                                <div class="form-group">
                                                    <label class="control-label font-weight-600">Show Thumbnail <span class="text-danger fw-bold">size(1920*1080) *</span></label>
                                                    <input type="file" class="form-control dropify" name="thumbnail" data-default-file="{{ (!empty($editshow)) ? Storage::disk('s3')->url($editshow->thumbnail) : '' }}">
                                                    @error('thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label font-weight-600">Description <span class="text-danger fw-bold">*</span></label>
                                                    <textarea class="form-control summernote" name="description" id="description">{{ old('description', !empty($editshow) ? $editshow->description : '') }}</textarea>
                                                    @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                        </div>
                        <div class="row m-2">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="mt-3 btn btn-primary  p-2 form-btn" id="videoBtn">SAVE <i class="fa fa-spin fa-spinner" id="videoSpin" style="display:none;"></i></button>
                                        <a href="{{ route('admin.showtype') }}"><button class="mt-3 btn btn-danger  p-2 form-btn" id=""><a class="text-white" href="{{ route('admin.showtype') }}">Cancel</a></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </form>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive m-2">
                            <table id="yajradb" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead id="sortable">
                                        <tr>
                                            <th>SR. NO.</th>
                                            <th>Title</th>
                                            <th>Subtitle</th>
                                            <!-- <th>Description</th> -->
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
                    <form action="{{route('admin.DeleteShowType')}}" method="post" enctype="multipart/form-data">
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
<script src="{{asset('assets/js/showtype.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
    
                var table = $('#yajradb').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.showtype') }}",
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },

                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'subtitle',
                            name: 'subtitle'
                        },
                        // {
                        // 	data: 'url',
                        // 	name: 'url'
                        // },


                        // {
                        // 	data: 'description',
                        // 	name: 'description'
                        // },

                        // {
                        // 	data: 'created_at',
                        // 	name: 'created_at'
                        // },
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
    </script>
    @endsection
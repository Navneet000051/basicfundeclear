@extends('admin.layout.master')
@section('content')
<style>
    .is-invalid-tagify {
        border-color: var(--bs-form-invalid-border-color);
        padding-right: calc(1.5em + .94rem);
        background-image: url('{{ asset("assets/images/error-icon.svg") }}');
        background-repeat: no-repeat;
        background-position: right calc(.375em + .235rem) center;
        background-size: calc(.75em + .47rem) calc(.75em + .47rem);
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        @if(!empty($editcontent))
                        <h4 class="mb-sm-0">Edit Index Content</h4>
                        <a href="{{route('admin.indexcontent')}}">
                            <!-- <button class="btn btn-primary">Add Index Content</button> -->
                        </a>
                        @else
                        <h4 class="mb-sm-0">Index Content</h4>
                        @endif
                    </div>

                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" id="addForm" action="{{ route('admin.addaboutcontent') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 mt-1">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="id" value="{{ old('id', !empty($editcontent) ? $editcontent->id : '') }}">
                                                    <label>Meta Title <span class="text-danger fw-bold">*</span></label>
                                                    <input type="text" class="form-control" name="metatitle" value="{{ old('metatitle', !empty($editcontent) ? $editcontent->metatitle : '') }}" required>
                                                    @error('metatitle')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="form-label">Meta Key <span class="text-danger fw-bold">*</span></label>
                                                    <input type="text" class="form-control metakey" name="metakey" value="{{ old('metakey', !empty($editcontent) ? $editcontent->metakey : '') }}">
                                                    @error('metakey')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Meta Description <span class="text-danger fw-bold">*</span></label>
                                                    <input type="text" class="form-control" name="metadescription" value="{{ old('metadescription', !empty($editcontent) ? $editcontent->metadescription : '') }}">
                                                    @error('metadescription')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1 mb-2">
                                        <div class="row">

                                        <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Select Content Type <span class="text-danger fw-bold">*</span></label>
                                                    <input type="file" id="fileInput" class="form-control" name="content" accept="image/*,video/*" value=""  {{ empty($editcontent) ? 'required' : '' }}>
                                                    @error('content')
                                                    <span class="text-danger">{{ $content }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Heading <span class="text-danger fw-bold">*</span></label>
                                                    <input type="text" class="form-control" name="heading" value="{{ old('heading', !empty($editcontent) ? $editcontent->heading : '') }}" required>
                                                    @error('heading')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="filePreview" class="d-none" style="width: 300px;display: flex; justify-content: center; align-items: center; overflow: hidden;">
                                        Your image or video will appear here
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label font-weight-600">Subheading <span class="text-danger fw-bold">*</span></label>
                                                    <!-- <textarea class="form-control summernote" name="subheading" id="description" required>{{ old('subheading', !empty($editcontact) ? $editcontact->subheading : '') }}</textarea> -->
                                                    <textarea class="form-control summernote" name="subheading" id="description" required>{{ old('subheading', !empty($editcontent) ? $editcontent->subheading : '') }}</textarea>
                                                    @error('subheading')
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
                                                    <label class="control-label font-weight-600">Description <span class="text-danger fw-bold">*</span></label>
                                                    <textarea class="form-control summernote" name="description" id="description">{{ old('description', !empty($editcontent) ? $editcontent->description : '') }}</textarea>
                                                    @error('description')
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
             
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- Delete Client Modal -->

        <!-- /.modal -->

        <!-- /Delete Client Modal -->
    </div>

    @endsection
    @section('externaljs')

    <script src="{{asset('assets/js/aboutcontent.js')}}"></script>
    <script>
        
//File Upload Js ***************************************************************************

$(document).ready(function() {
    // Function to show file preview
    function showFilePreview(fileUrl, fileType) {
        const preview = $('#filePreview');
        preview.empty();

        if (fileUrl) {
            if (fileType.startsWith('image/')) {
                $('<img>').attr('src', fileUrl).css({
                    maxWidth: '100%',
                    maxHeight: '100%'
                }).appendTo(preview);
                preview.removeClass('d-none');
            } else if (fileType.startsWith('video/')) {
                $('<video>').prop({
                    controls: true,
                    src: fileUrl,
                    autoplay: true,
                    muted: false,
                    loop: true
                }).css({
                    maxWidth: '100%',
                    maxHeight: '100%'
                }).appendTo(preview);
                preview.removeClass('d-none');
            } else {
                preview.addClass('d-none');
            }
        } else {
            preview.addClass('d-none');
        }
    }

    // Show existing file preview on page load
    const existingFile = "{{ isset($editcontent) ? Storage::disk('s3')->url($editcontent->content) : '' }}";
    const existingFileExtension = "{{ isset($editcontent) ? pathinfo($editcontent->content, PATHINFO_EXTENSION) : '' }}";
    const existingFileType = existingFileExtension === 'mp4' || existingFileExtension === 'avi' || existingFileExtension === 'mov' || existingFileExtension === 'wmv' ? 'video/' + existingFileExtension : 'image/' + existingFileExtension;

    if (existingFile) {
        showFilePreview(existingFile, existingFileType);
    }

    // Show new file preview on file input change
    $('#fileInput').change(function(event) {
        const file = event.target.files[0];
        if (file) {
            showFilePreview(URL.createObjectURL(file), file.type);
        } else {
            $('#filePreview').addClass('d-none');
        }
    });
});

    </script>
    @endsection
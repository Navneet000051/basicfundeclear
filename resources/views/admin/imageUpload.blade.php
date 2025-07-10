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
                      
                        <h4 class="mb-sm-0">laravel File Uploading with Amazon S3</h4>
                   
                    </div>

                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="panel panel-primary">

      <div class="panel-body">
     
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="{{ Session::get('image') }}">
        @endif
    
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('admin.image.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
    
                <div class="col-md-6">
                    <input type="file" name="image" class="form-control">
                </div>
     
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
     
            </div>
        </form>
    
      </div>
    </div>

                        </div>
                    </div>
                </div>
               
            </div> <!-- container-fluid -->
        </div>
        <!-- Delete Client Modal -->


        <!-- /.modal -->

        <!-- /Delete Client Modal -->
    </div>

    @endsection


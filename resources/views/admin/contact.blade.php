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
                        <a href="{{route('admin.show')}}">
                            <button class="btn btn-primary">Add Show Type</button>
                        </a>
                        @else
                        <h4 class="mb-sm-0">Contact</h4>
                        @endif
                    </div>

                </div>
            </div>
           
            <!-- end page title -->
         

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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
    $('#yajradb').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.contact') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'message', name: 'message' }
        ]
    });
});
        });
    </script>
    @endsection
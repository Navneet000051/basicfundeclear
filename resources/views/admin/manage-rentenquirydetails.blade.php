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
                        <h4 class="mb-sm-0">Rent Enquiry</h4>
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
                                            <th>Mobile</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Duration</th>
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
      

</div>

@endsection
@section('externaljs')

    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
    $('#yajradb').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.rentenquirydetails') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'duration', name: 'duration' },
            { data: 'message', name: 'message' }
        ]
    });
});
        });
    </script>
    @endsection
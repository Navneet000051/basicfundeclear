<?php

namespace App\Http\Controllers;

use App\Models\RentEnquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RentEnquiryController extends Controller
{
     public function index(Request $request, $id = '')
    {
        $tableName = (new RentEnquiry())->getTable();
        $data['tablename'] = $tableName;
        $data['title'] = 'Manage Rent Enquiry';
        $data['rent_enquiries'] = RentEnquiry::get();
if ($request->ajax()) {
    $data = RentEnquiry::select('id', 'name', 'email', 'mobile', 'start_date', 'end_date', 'message')
        ->orderBy('id', 'desc')
        ->get();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('duration', function ($row) {
            if ($row->start_date && $row->end_date) {
                $start = \Carbon\Carbon::parse($row->start_date);
                $end = \Carbon\Carbon::parse($row->end_date);
                $days = $start->diffInDays($end) + 1;
                return $days . ' day' . ($days > 1 ? 's' : '');
            }
            return '-';
        })
        ->make(true);
}


        return view('admin.manage-rentenquirydetails', $data);
    }
}

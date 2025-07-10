<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $tableName = (new Contact)->getTable();
        $data['tablename'] = $tableName;
        $data['title'] = 'Manage Contact';
        $data['contact'] = Contact::get();
        if ($request->ajax()) {
            $data = Contact::select('id', 'name', 'email', 'message')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.contact', $data);
    }
}

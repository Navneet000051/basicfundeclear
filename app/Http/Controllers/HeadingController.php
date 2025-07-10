<?php

namespace App\Http\Controllers;

use App\Models\CreateSection;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class HeadingController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $tableName = (new CreateSection)->getTable();
        $data['tablename'] = $tableName;
        if ($id != '') {

            $id = decrypt($id);
            $data['editcontact'] = CreateSection::where('id', $id)->first();
        } else {
            $data['editcontact'] = '';
        }

        $data['title'] = 'Manage Heading';
        $data['heading'] = CreateSection::where('status', 1)->get();


        if ($request->ajax()) {
            $data = CreateSection::orderBy('position_by', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($tableName) {
                    $encryptedId = encrypt($row->id);
                    $actionBtn = '<div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn text-dark waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-xl-inline-block ms-1">
                                <div class="badge bg-info-subtle text-info font-size-12"><i class="ri-settings-2-line"></i></div>
                            </span>
                            <i class="mdi mdi-chevron-down d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="' . route('admin.editheading', ['id' => $encryptedId]) . '">
                                <i class="mdi mdi-pencil-outline"></i> Edit
                            </a>
                        <!---    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')">
                                <i class="mdi mdi-trash-can-outline"></i> Delete
                            </a>-->
                        </div>
                    </div>';
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) use ($tableName) {
                    if ($row->status == 1) {
                        return "<div class='dropdown d-inline-block user-dropdown'>
                            <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <div class='badge bg-success-subtle text-success font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='PendingSpin{$row->id}'></i>Active</div>
                                <i class='mdi mdi-chevron-down d-xl-inline-block'></i>
                            </button>
                            <div class='dropdown-menu dropdown-menu-end'>
                                <a class='dropdown-item' style='cursor:pointer;' onclick=\"changeStatus('id', '{$row->id}', 'status', '0', '{$tableName}')\"> Inactive</a> 
                            </div>
                        </div>";
                    } else {
                        return "<div class='dropdown d-inline-block user-dropdown'>
                            <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <span class='d-xl-inline-block ms-1'>
                                    <div class='badge bg-danger-subtle text-danger font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='publicationSpin{$row->id}'></i> Inactive</div>
                                </span>
                                <i class='mdi mdi-chevron-down d-xl-inline-block'></i>
                            </button>
                            <div class='dropdown-menu dropdown-menu-end'>
                                <a class='dropdown-item' style='cursor:pointer;' onclick=\"changeStatus('id', '{$row->id}', 'status', '1', '{$tableName}')\"> Active</a>
                            </div>
                        </div>";
                    }
                })
                ->setRowAttr([
                    'data-id' => function ($row) {
                        return $row->id;
                    },
                ])
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.manage-heading', $data);
    }





    public function save(Request $request)
    {
        $total = CreateSection::count();
        $position_by = $total + 1;


        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'heading' => 'required|string|max:255',
                'subheading' => 'required|string',
            ]);
            $show = CreateSection::find($request->id);
            if (!empty($show)) {
                $show->update([
                    'heading' => $request->heading,
                    'subheading' => $request->subheading,

                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Heading with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'heading' => 'required|string|max:255',
                'subheading' => 'required|string',
            ]);
            // Create a new Show instance
            $show = new CreateSection();
            $show->heading = $request->heading;
            $show->subheading = $request->subheading;
            $show->position_by = $position_by;
            $show->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.heading');
    }
}

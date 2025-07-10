<?php

namespace App\Http\Controllers;

use App\Models\ShowAssignModel;
use App\Models\ShowTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ShowTypeController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $tableName = (new ShowTypeModel)->getTable();
        $data['tablename'] = $tableName;
        $data['title'] = 'Show Type';
        if ($id != '') {

            $id = decrypt($id);
            $data['editshow'] = ShowTypeModel::where('id', $id)->first();
        } else {
            $data['editshow'] = '';
        }
        $data['shows'] = ShowTypeModel::get();

        if ($request->ajax()) {
            $data = ShowTypeModel::orderBy('position_by', 'asc')
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
                            <a class="dropdown-item" href="' . route('admin.editshowtype', ['id' => $encryptedId]) . '">
                                <i class="mdi mdi-pencil-outline"></i> Edit
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')">
                                <i class="mdi mdi-trash-can-outline"></i> Delete
                            </a>
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
        return view('admin.showtype', $data);
    }

    public function save(Request $request)
    {
        $total = ShowTypeModel::count();
        $position_by = $total + 1;
        //    dd($request->all());
        // Check if it's an update operation
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('showtype', 's3');

            // Delete the old thumbnail if updating an existing record
            if (!empty($request->id)) {
                $show = ShowTypeModel::find($request->id);
                // if (!empty($show->thumbnail)) {
                //     Storage::disk('public')->delete($show->thumbnail);
                // }
                   // Extract the file name from the S3 path
                   $fileName = basename($show->thumbnail);

                   // Delete the file from S3
                   Storage::disk('s3')->delete('showtype/' . $fileName);

                
            }
        }
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                // 'description' => 'nullable|string',
            ]);
            $show = ShowTypeModel::find($request->id);
            if (!empty($show)) {
                // dd($imagePath);

                if ($show->update([
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'description' => $request->description,
                    'thumbnail' => isset($imagePath) ? $imagePath : $show->thumbnail, // Update thumbnail only if a new one is uploaded
                ])) {
                    Session::flash('success', 'Data updateddd successfully!');
                } else {
                    Session::flash('error', 'Data not updated!');
                }
            } else {
                Session::flash('error', 'Data with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048', // Assuming image uploads
                // 'description' => 'required|string',

            ]);
            // Create a new Show instance
            $show = new ShowTypeModel();
            $show->title = $request->title;
            $show->subtitle = $request->subtitle;
            $show->description = $request->description;
            $show->position_by = $position_by;
            $show->thumbnail = $imagePath; // Assuming you have a 'thumbnail' field in your 'shows' table
            $show->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.showtype');
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        $where_column = $request->column;
        $where_id = $request->Id;
        $where_table = $request->table;

        // Check if any associated investment details exist
        if (ShowAssignModel::where('showtype_id', $where_id)->exists()) {
            return redirect()->back()->with('error', "First delete all its shows");
        } else {
            // Update status to 0
            $deleted = DB::table($where_table)
                ->where($where_column, $where_id)
                ->delete();

            if ($deleted) {
                return redirect()->back()->with('success', 'Data deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Data not deleted');
            }
        }
    }

}

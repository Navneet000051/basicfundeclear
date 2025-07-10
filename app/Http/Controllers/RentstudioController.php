<?php

namespace App\Http\Controllers;

use App\Models\RentStudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RentstudioController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $tableName = (new RentStudio)->getTable();
        $data['tablename'] = $tableName;
        if ($id != '') {

            $id = decrypt($id);
            $data['editrentstudio'] = RentStudio::where('id', $id)->first();
        } else {
            $data['editrentstudio'] = '';
        }

        $data['title'] = 'Rent Studios';
        $data['rentstudios'] = RentStudio::where('status', 1)->get();
        if ($request->ajax()) {
            $data = RentStudio::orderBy('position_by', 'asc')->get();
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
                            <a class="dropdown-item" href="' . route('admin.editrentstudio', ['id' => $encryptedId]) . '">
                                <i class="mdi mdi-pencil-outline"></i> Edit
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')">
                                <i class="mdi mdi-trash-can-outline"></i> Delete
                            </a>
                        </div>
                    </div>';
                    return $actionBtn;
                })
                ->addColumn('thumbnail', function ($row) {
                    $thumbnail = '<img src="' . Storage::disk('s3')->url($row->thumbnail) . '" width="80">';
                    return $thumbnail;
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
                ->rawColumns(['action', 'thumbnail', 'status'])
                ->make(true);
        }
        return view('admin.manage-rentstudio', $data);
    }

    public function save(Request $request)
    {

        $total = RentStudio::count();
        $position_by = $total + 1;
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('rentstudio', 's3');

            if (!empty($request->id)) {
                $rentstudio = RentStudio::find($request->id);
                if (!empty($rentstudio->thumbnail)) {
                    $fileName = basename($rentstudio->thumbnail);
                    Storage::disk('s3')->delete('rentstudio/' . $fileName);
                }
            }
        }

        if (!empty($request->id)) {
            $request->validate([
                'title' => 'required|string|max:255',
            ]);
            $rentstudio = RentStudio::find($request->id);
            if (!empty($rentstudio)) {
                $rentstudio->update([
                    'title' => $request->title,
                    'url' => $request->url,
                    'thumbnail' => isset($imagePath) ? $imagePath : $rentstudio->thumbnail, // Update thumbnail only if a new one is uploaded
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'RentStudio with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'title' => 'required|string|max:255',   
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:51200', // max 50MB

            ]);

            $rentstudio = new RentStudio();
            $rentstudio->title = $request->title;
            $rentstudio->url = $request->url;
            $rentstudio->thumbnail = $imagePath;
            $rentstudio->position_by = $position_by;
            $rentstudio->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.rentstudio');
    }
}

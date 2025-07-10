<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TeamMemberController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $tableName = (new TeamMember)->getTable();
        $data['tablename'] = $tableName;
        if ($id != '') {

            $id = decrypt($id);
            $data['editteammember'] = TeamMember::where('id', $id)->first();
        } else {
            $data['editteammember'] = '';
        }
     
        $data['title'] = 'Team Member';
        $data['shows'] = TeamMember::where('status', 1)->get();
   
        
        if ($request->ajax()) {
            $data = TeamMember::orderBy('position_by', 'asc')
            -> get();
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
                            <a class="dropdown-item" href="' . route('admin.editteammember', ['id' => $encryptedId]) . '">
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
        
        
        
        
        return view('admin.teammember', $data);
    }



    public function save(Request $request)
    {
        $total = TeamMember::count();
        $position_by = $total + 1;
        //    dd($request->all());
        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('teammember', 's3');

            // Delete the old thumbnail if updating an existing record
            if (!empty($request->id)) {
                $teammember = TeamMember::find($request->id);
                if (!empty($teammember->thumbnail)) {
                    $fileName = basename($teammember->thumbnail);

                    // Delete the file from S3
                    Storage::disk('s3')->delete('teammember/' . $fileName);
                }
            }
        }

        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'required|string',
                'description' => 'nullable|string',
               
            ]);
            $teammember = TeamMember::find($request->id);
            if (!empty($teammember)) {
                $teammember->update([
                    'name' => $request->name,
                    'designation' => $request->designation,
                    'description' => $request->description,
                   
                    'thumbnail' => isset($imagePath) ? $imagePath : $teammember->thumbnail, // Update thumbnail only if a new one is uploaded
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Team member with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'required|string',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048', // Assuming image uploads
                // 'description' => 'required|string',
    
            ]);
            // Create a new Show instance
            $teammember = new TeamMember();
            $teammember->name = $request->name;
            $teammember->designation = $request->designation;
            $teammember->thumbnail = $imagePath; // Assuming you have a 'thumbnail' field in your 'shows' table
            $teammember->description = $request->description;
           
            $teammember->position_by = $position_by;
            $teammember->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.teammember');
    }


    private function getEmbeddedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches) || preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
            return 'https://www.youtube.com/embed/' . $youtube_id;
        }

        // Return the original URL if no match is found
        return $url;
    }
}

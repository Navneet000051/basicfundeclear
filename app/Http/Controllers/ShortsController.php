<?php

namespace App\Http\Controllers;

use App\Models\ShortsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ShortsController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $tableName = (new ShortsModel)->getTable();
        $data['tablename'] = $tableName;
        if ($id != '') {

            $id = decrypt($id);
            $data['editshow'] = ShortsModel::where('id', $id)->first();
        } else {
            $data['editshow'] = '';
        }
     
        $data['title'] = 'Shows';
        $data['shows'] = ShortsModel::where('status', 1)->get();
   
        
        if ($request->ajax()) {
            $data = ShortsModel::orderBy('position_by', 'asc')
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
                            <a class="dropdown-item" href="' . route('admin.editshorts', ['id' => $encryptedId]) . '">
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
        
        
        
        
        return view('admin.manage-shorts', $data);
    }





    public function save(Request $request)
    {
        $total = ShortsModel::count();
        $position_by = $total + 1;
        //    dd($request->all());
        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('shorts', 's3');

            // Delete the old thumbnail if updating an existing record
            if (!empty($request->id)) {
                $show = ShortsModel::find($request->id);
                if (!empty($show->thumbnail)) {
                    // Storage::disk('public')->delete($show->thumbnail);
                    $fileName = basename($show->thumbnail);

                    // Delete the file from S3
                    Storage::disk('s3')->delete('showtype/' . $fileName);
                }
            }
        }

        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required|url',

                'description' => 'nullable|string',
                // 'metatitle' => 'required|string|max:255',
                // 'metakey' => 'required|string|max:255',
                // 'metadescription' => 'required|string|max:255',
            ]);
            $show = ShortsModel::find($request->id);
            if (!empty($show)) {
                $show->update([
                    'title' => $request->title,
                    'url' => $request->url,
                    'description' => $request->description,
                    'metatitle' => $request->metatitle,
                    'metakey' => $request->metakey,
                    'metadescription' => $request->metadescription,
                    'thumbnail' => isset($imagePath) ? $imagePath : $show->thumbnail, // Update thumbnail only if a new one is uploaded
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Shorts with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required|url',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048', // Assuming image uploads
                // 'description' => 'required|string',
                // 'metatitle' => 'required|string|max:255',
                // 'metakey' => 'required|string|max:255',
                // 'metadescription' => 'required|string|max:255',
            ]);
            // Create a new Show instance
            $show = new ShortsModel();
            $show->title = $request->title;
            $show->url = $request->url;
            $show->thumbnail = $imagePath; // Assuming you have a 'thumbnail' field in your 'shows' table
            $show->description = $request->description;
            $show->metatitle = $request->metatitle;
            $show->metakey = $request->metakey;
            $show->metadescription = $request->metadescription;
            $show->position_by = $position_by;
            $show->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.shorts');
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

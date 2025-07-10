<?php

namespace App\Http\Controllers;

use App\Models\IndexContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class IndexContentController extends Controller
{
    public function index(Request $request)
    {
        $tableName = (new IndexContent)->getTable();
        $data['tablename'] = $tableName;
  
     
        $data['title'] = 'Index Content';
        $data['editcontent'] = IndexContent::where('status', 1)->first();
   
     
        return view('admin.indexcontent', $data);
    }


  public function save(Request $request)
    {
      
        $total = IndexContent::count();
        $position_by = $total + 1;
    
        // Initialize $filePath
        $filePath = '';
    
        // Handle file upload
        if ($request->hasFile('content')) {
            // Generate a unique name for the file
            $fileName = time() . '.' . $request->content->extension();
            $file = $request->file('content');
            $filePath = $file->store('website', 's3');
            // Delete the old content if updating an existing record
            if (!empty($request->id)) {
                $indexcontent = IndexContent::find($request->id);
                if (!empty($indexcontent->content)) {
                    Storage::disk('s3')->delete($indexcontent->content);
                }
            }
        }
       
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'heading' => 'required',
                'subheading' => 'required',
                'ytlink' => 'required|url',
                'attribute' => 'required|string',
                'description' => 'required|string',
                'metatitle' => 'required|string',
                'metakey' => 'required|string',
                'metadescription' => 'required|string',
            ]);
    
            
            $indexcontent = IndexContent::find($request->id);
            if (!empty($indexcontent)) {
                $indexcontent->update([
                    'heading' => $request->heading,
                    'subheading' => $request->subheading,
                    'watchlink' => $request->watchlink,
                    'ytlink' => $request->ytlink,
                    'attribute' => $request->attribute,
                    'description' => $request->description,
                    'metatitle' => $request->metatitle,
                    'metakey' => $request->metakey,
                    'metadescription' => $request->metadescription,
                    'content' => !empty($filePath) ? $filePath : $indexcontent->content, // Update content only if a new one is uploaded
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Content with ID ' . $request->id . ' not found.');
            }
        } else {
            // Validate the incoming request data
            $request->validate([
                'heading' => 'required',
                'subheading' => 'required',
                'watchlink' => 'required|url',
                'ytlink' => 'required|url',
                'attribute' => 'required|string',
                // 'content' => 'required|mimes:jpeg,png,jpg,webp,mp4,avi,mov,wmv', // Adjust the max size as needed
                'description' => 'required|string',
                'metatitle' => 'required|string',
                'metakey' => 'required|string',
                'metadescription' => 'required|string',
            ]);
    
            // Create a new indexcontent instance
            $indexcontent = new IndexContent();
            $indexcontent->heading = $request->heading;
            $indexcontent->subheading = $request->subheading;
            $indexcontent->watchlink = $request->watchlink;
            $indexcontent->ytlink = $request->ytlink;
            $indexcontent->attribute = $request->attribute;
            $indexcontent->content = $filePath; // Store only the relative path
            $indexcontent->description = $request->description;
            $indexcontent->metatitle = $request->metatitle;
            $indexcontent->metakey = $request->metakey;
            $indexcontent->metadescription = $request->metadescription;
            $indexcontent->position_by = $position_by;
            $indexcontent->save();
            Session::flash('success', 'Data added successfully!');
        }
    
        // Redirect back with success or error message
        return redirect()->route('admin.indexcontent');
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

<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AboutContentController extends Controller
{
    public function index(Request $request)
    {
        $tableName = (new AboutContent)->getTable();
        $data['tablename'] = $tableName;
  
     
        $data['title'] = 'About Content';
        $data['editcontent'] = AboutContent::where('status', 1)->first();
   
     
        return view('admin.aboutcontent', $data);
    }



    public function save(Request $request)
    {
        // dd($request->all());
        $total = AboutContent::count();
        $position_by = $total + 1;
      
        // if ($request->hasFile('content')) {
        //     $imagePath = $request->file('content')->store('website', 'public');

        //     if (!empty($request->id)) {
        //        $AboutContent = AboutContent::find($request->id);
        //         if (!empty($AboutContent->content)) {
        //             Storage::disk('public')->delete($AboutContent->content);
        //         }
        //     }
        // }

        if ($request->hasFile('content')) {
            // Generate a unique name for the file
            $fileName = time() . '.' . $request->content->extension();
    
            // Upload the file to the 'website' folder in the S3 bucket
            $file = $request->file('content');
            $filePath = $file->store('website', 's3');
    
            // Delete the old content if updating an existing record
            if (!empty($request->id)) {
                $AboutContent = AboutContent::find($request->id);
                if (!empty($AboutContent->content)) {
                    // Delete the old file from S3
                    Storage::disk('s3')->delete($AboutContent->content);
                }
            }
        }

        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'heading' => 'required',
                'subheading' => 'required',
                'description' => 'required|string',
                'metatitle' => 'required|string',
                'metakey' => 'required|string',
                'metadescription' => 'required|string',
            ]);
           $AboutContent = AboutContent::find($request->id);
            if (!empty($AboutContent)) {
                // dd($request->all());
               $AboutContent->update([
                    'heading' => $request->heading,
                    'subheading' => $request->subheading,
                    'description' => $request->description,
                    'metatitle' => $request->metatitle,
                    'metakey' => $request->metakey,
                    'metadescription' => $request->metadescription,
                    'content' => isset($filePath) ? $filePath :$AboutContent->content, // Update content only if a new one is uploaded
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Shorts with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'heading' => 'required',
                'subheading' => 'required',
                'content' => 'required|image|mimes:jpeg,png,jpg,webp,mp4.gif|max:2048', // Assuming image uploads
                'description' => 'required|string',
                'metatitle' => 'required|string',
                'metakey' => 'required|string',
                'metadescription' => 'required|string',
            ]);
            // Create a new AboutContent instance
           $AboutContent = new AboutContent();
           $AboutContent->heading = $request->heading;
           $AboutContent->subheading = $request->subheading;
           $AboutContent->content = $filePath; // Assuming you have a 'content' field in your 'AboutContent' table
           $AboutContent->description = $request->description;
           $AboutContent->metatitle = $request->metatitle;
           $AboutContent->metakey = $request->metakey;
           $AboutContent->metadescription = $request->metadescription;
           $AboutContent->position_by = $position_by;
           $AboutContent->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.aboutcontent');
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
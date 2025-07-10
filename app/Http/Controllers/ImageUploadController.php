<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('admin.imageUpload');
    }

    /**
     * Handle the image upload.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        // Validate the image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Generate a unique name for the image
        $imageName = time() . '.' . $request->image->extension();

        // Upload the image to the 'test' folder in the S3 bucket
        $image = $request->file('image');
        $path = $image->store('test', 's3'); 

        // Get the URL of the uploaded image
        $path = Storage::disk('s3')->url($path);

        // You can store the $imageName or $filePath in your database if needed

        // Return back with a success message and the image URL
        return back()
            ->with('success', 'You have successfully uploaded an image.')
            ->with('image', $path);
    }
}

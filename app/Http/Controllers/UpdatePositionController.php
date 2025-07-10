<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdatePositionController extends Controller
{
  public function index(Request $request){
//  dd($request->all());
    $newOrder = $request->newOrder;
    $tablename = $request->tablename;

    // Update positions in the database
    foreach ($newOrder as $index => $id) {
        // Increment index by 1 to start from 1 instead of 0
        $position = $index + 1;

        DB::table($tablename)->where('id', $id)->update(['position_by' => $position]);
    }

    return response()->json(['success' => true]);
  }
}

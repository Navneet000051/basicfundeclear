<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class deleteController extends Controller
{
    public function destroy(Request $request){
        // dd($request->all());
        $where_column = $request->column;
        $where_id = $request->Id;
        $where_table = $request->table;
        if(DB::table($where_table)->where($where_column, $where_id)->delete()){
            return redirect()->back()->with('success', 'Data deleted successfully');
        }
        else{
            return redirect()->back()->with('error', 'Data Not Deleted');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class changeStatusController extends Controller
{
    public function changeStatus(Request $request)
    {
        $table = $request->where_table;
        $id = $request->where_id;
        $idValue = $request->where_id_value;
        $column = $request->where_column;
        $columnValue = $request->where_column_value;

        if ($table && $id && $idValue && $column !== null) {
            // Update status
            $updateResult = DB::table($table)
                ->where($id, $idValue)
                ->update([$column => $columnValue]);

            if ($updateResult !== false) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Update Error']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid parameters']);
        }
    }
 public function changePublicationStatus(Request $request)
    {
        $table = $request->where_table;
        $id = $request->where_id;
        $idValue = $request->where_id_value;
        $column = $request->where_column;
        $columnValue = $request->where_column_value;

        if ($table && $id && $idValue && $column !== null) {
            // Update status
            $updateResult = DB::table($table)
                ->where($id, $idValue)
                ->update([$column => $columnValue]);

            if ($updateResult !== false) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Update Error']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid parameters']);
        }
    }
}

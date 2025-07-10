<?php

namespace App\Http\Controllers;

use App\Models\ShowAssignModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
   public function QissonKiKitab()
    {
        $output = [
            'result' => 'error',
            'message' => 'No data found'
        ];
    
        $data = ShowAssignModel::where(['showtype_id'=> 11, 'publication_status'=>1,'status'=>1])->orderBy('position_by', 'asc')->take(5)->get();
    
        if ($data->isEmpty()) {
            return response()->json($output);
        }
    
        $output['result'] = 'success';
        $output['message'] = 'Data found';
        $output['data'] = $data;
    
        return response()->json($output);
    }

    
}

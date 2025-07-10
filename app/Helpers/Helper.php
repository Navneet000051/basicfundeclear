<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helper {
 
    public static function updatePositions($newOrderid,$position)
    {
        $newOrder = $newOrderid;

        // Update positions in the database
        foreach ($newOrder as $index => $id) {
            // Increment index by 1 to start from 1 instead of 0
            $position = $index + 1;

            DB::table('users')->where('id', $id)->update(['position_by' => $position]);
        }

        return response()->json(['success' => true]);
    }
}

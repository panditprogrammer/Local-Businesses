<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppRelease;
use Illuminate\Http\Request;

class AppReleaseController extends Controller
{
    public function getInfo()
    {
        $data = AppRelease::latest()->first();

        if ($data) {
            $data['url'] = asset("/storage") . "/" . $data['url'];
            return response()->json(['success' => true, 'message' => 'App Version info', 'data' => $data]);
        }
        return response()->json(['success' => false, 'message' => 'No info available', 'data' => $data]);
    }
}

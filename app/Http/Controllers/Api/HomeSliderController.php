<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomePageSlider;

class HomeSliderController extends Controller
{
    public function getAll()
    {
        $data['sliders'] = HomePageSlider::where("status",true)->get();
        return response()->json(["success" => true, "message" => "Sliders retrived successfully", "data" => $data]);
    }
}

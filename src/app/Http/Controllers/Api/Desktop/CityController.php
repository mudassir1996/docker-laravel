<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index(Request $request)
    {

        $cities = DB::table('cities')->get();
        return response()->json(
            ['Cities' => $cities]
        );
    }
}

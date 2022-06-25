<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function index(Request $request)
    {

        $states = DB::table('states')->get();
        return response()->json(
            ['States' => $states]
        );
    }
}

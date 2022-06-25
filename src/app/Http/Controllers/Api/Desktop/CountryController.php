<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index(Request $request)
    {

        $countries = DB::table('countries')->get();
        return response()->json(
            ['Countries' => $countries]
        );
    }
}

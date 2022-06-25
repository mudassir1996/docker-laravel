<?php

namespace App\Http\Controllers\Api\Desktop;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Screen;
use Illuminate\Http\Request;

class ScreensController extends Controller
{
    public function index()
    {
        $screens = Screen::all();
        return response()->json(
            ['Screens' => $screens]
        );
    }
}

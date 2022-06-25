<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\FcmToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FcmController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required'
        ]);

        $fcm_token = FcmToken::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'fcm_token' => $request->fcm_token,
            ]
        );

        if ($fcm_token) {
            return response(
                [
                    'message' => 'Record Added!'
                ],
                200
            );
        } else {
            return response(
                [
                    'message' => 'Something went wrong!'
                ],
                401
            );
        }
    }
}

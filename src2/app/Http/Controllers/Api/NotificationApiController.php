<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationApiController extends Controller
{
    public function get_unread_notification($outlet_id)
    {
        $outlet =  DB::table('outlets')->where('id', $outlet_id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $unread_notification = DB::table('notification_outlet')->where('outlet_id', $outlet_id)->where('read_at', null)->get();
                return response()->json([
                    'unread_notifications' => count($unread_notification)
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }
    public function get_notification($outlet_id)
    {
        $outlet =  DB::table('outlets')->where('id', $outlet_id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $notifications = DB::table('notification_outlet')
                    ->leftJoin('notifications', 'notifications.id', 'notification_outlet.notification_id')
                    ->where('notification_outlet.outlet_id', $outlet_id)
                    ->orderBy('notification_outlet.id', 'desc')
                    ->select('notifications.title', 'notifications.description', 'notification_outlet.read_at', 'notification_outlet.created_at', 'notification_outlet.updated_at')
                    ->get();
                return response()->json([
                    'OutletNotifications' => $notifications
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }
    public function mark_read_notification($outlet_id)
    {
        $outlet =  DB::table('outlets')->where('id', $outlet_id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $notificaiton = DB::table('notification_outlet')
                    ->where('outlet_id', $outlet_id)
                    ->where('read_at', null)
                    ->update(['read_at' => Carbon::now()]);

                if ($notificaiton) {
                    return response()->json([
                        'success' => [
                            'message' => 'All notification marked as read'
                        ]
                    ]);
                } else {
                    return response(
                        [
                            'message' => 'Something went wrong!'
                        ],
                        401
                    );
                }
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }
}

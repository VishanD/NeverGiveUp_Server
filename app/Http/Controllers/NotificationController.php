<?php

namespace App\Http\Controllers;

use App\app_users;
use Illuminate\Http\Request;
use App\notification;
use App\newNotification;
use App\userCategory;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //get the user id from the fb id, only fb id is send from the mobile app
        $user_id_app = app_users::where('fb_profile_id','=',$user_id)
            ->first();

        if(empty($user_id_app))
        {
            $id = "2";
        }
        else{

            $id = $user_id_app->id;
        }


        $all_notifications = array();

        $all_notification_ids_for_this_user = newNotification::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach($all_notification_ids_for_this_user as $this_id) {

            $notification = notification::find($this_id->notification_id);
            array_push($all_notifications, $notification->message);
        }

        return response()->json([
                'status' => 'success',
                'data' => $all_notifications
            ]
        )->setStatusCode(200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUnread($user_id)
    {
        //get the user id from the fb id, only fb id is send from the mobile app
        $user_id_app = app_users::where('fb_profile_id','=',$user_id)
            ->first();

        if(empty($user_id_app))
        {
            $id = "2";
        }
        else{

            $id = $user_id_app->id;
        }

        $all_notifications = array();

        $all_notification_ids_for_this_user = newNotification::where('user_id', $id)
            ->where('read_status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach($all_notification_ids_for_this_user as $this_id) {

            $notification = notification::find($this_id->notification_id);
            array_push($all_notifications, $notification->message);
        }

        return response()->json([
                'status' => 'success',
                'data' => $all_notifications
            ]
        )->setStatusCode(200);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category, $message)
    {

        $parsed_message = str_replace("_", " ", $message);

        $notification = new notification();
        $notification->message = $parsed_message;
        $notification->category = $category;
        $notification->save();

        $allUsers = userCategory::where('category', $category)->get();

        foreach($allUsers as $user) {
            $user_id = $user->user_id;

            $newNotification = new newNotification();

            $newNotification->user_id = $user_id;
            $newNotification->notification_id = $notification->id;
            $newNotification->read_status = 0;
            $newNotification->save();
        }

        return response()->json([
                'status' => 'success',
            ]
        )->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {

        //get the user id from the fb id, only fb id is send from the mobile app
        $user_id_app = app_users::where('fb_profile_id','=',$user_id)
            ->first();

        if(empty($user_id_app))
        {
            $id = "2";
        }
        else{

            $id = $user_id_app->id;
        }

        $all_notification_ids_for_this_user = newNotification::where('user_id', $id)
            ->get();

        foreach($all_notification_ids_for_this_user as $this_id) {

            $this_id->read_status = 1;
            $this_id->save();
        }

        return response()->json([
                'status' => 'success'
            ]
        )->setStatusCode(200);
    }

}

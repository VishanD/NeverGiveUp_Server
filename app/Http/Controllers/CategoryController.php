<?php

namespace App\Http\Controllers;

use App\app_users;
use App\userCategory;
use Illuminate\Http\Request;
use App\category;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();

        return response()->json([
                'status' => 'success',
                'data' => $categories
            ]
        )->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * subscribe a category
     *
     * @param $user_id
     * @param $category
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function subscribe($user_id,$category)
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

        $user_category = new userCategory();

        $user_category->user_id = $id;
        $user_category->category = $category;

        $user_category->save();

        return response()->json([
                'status' => 'success',
            ]
        )->setStatusCode(200);


    }


    /**
     *Unsubscribe a category
     *
     * @param $user_id
     * @param $category
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function unsubscribe($user_id,$category)
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

        $user_category = userCategory::where('user_id','=',$id)
                                    ->where('category','=',$category)
                                    ->delete();

        if($user_category >0)
        {
            return response()->json([
                    'status' => 'success',
                ]
            )->setStatusCode(200);

        }
        else{
            return response()->json([
                    'status' => 'fail',

                ]
            )->setStatusCode(404);
        }



    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\app_users;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AppUsersController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $image = $request->file('profile_picture');
        $path = public_path()."/profile_pics/";

        $user = new app_users();

        $image->move($path, $data['email']."jpg");


        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->profile_picture = $path.$data['email'].".jpg";
        $user->save();

        return response()->json([
                'status' => 'success',
                'data' => $user
            ]
        )->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = app_users::find($id);

        if ($user == null) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $user
                ]
            )->setStatusCode(404);
        }

        else {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $user
                ]
            )->setStatusCode(200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $image = $request->file('profile_picture');

        $user = app_users::find($id);

        if ($user == null || !Input::hasFile('profile_picture')) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $user
                ]
            )->setStatusCode(404);
        }

        else {

            $path = public_path()."/profile_pics/";

            $image->move($path, $data['email']."jpg");


            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->date_of_birth = $data['date_of_birth'];
            $user->profile_picture = $path.$data['email'].".jpg";
            $user->save();

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $user
                ]
            )->setStatusCode(200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = app_users::find($id);

        if ($user == null) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $user
                ]
            )->setStatusCode(404);
        }

        else {

            $user->delete();

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $user
                ]
            )->setStatusCode(200);
        }
    }
}

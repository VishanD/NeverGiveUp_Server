<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\posts;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        $all_posts = posts::where('category', $category)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
                'status' => 'success',
                'data' => $all_posts
            ]
        )->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $post = new posts();

        $post->upvotes = $data['upvotes'];
        $post->downvotes = $data['downvotes'];
        $post->user_id = $data['user_id'];
        $post->category = $data['category'];
        $post->postContent = $data['postContent'];

        $post->save();

        return response()->json([
                'status' => 'success',
                'data' => $post
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
        $post = posts::find($id);

        if ($post == null) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $post
                ]
            )->setStatusCode(404);
        }

        else {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => $post
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
    public function edit($id, Request $request)
    {
        $data = $request->all();

        $post = posts::find($id);

        if ($post == null) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $post
                ]
            )->setStatusCode(404);
        }

        else {
            $post->upvotes = $data['upvotes'];
            $post->downvotes = $data['downvotes'];
            $post->postContent = $data['postContent'];
            $post->save();

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $post
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
        $post = posts::find($id);

        if ($post == null) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $post
                ]
            )->setStatusCode(404);
        }

        else {

            $post->delete();

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $post
                ]
            )->setStatusCode(200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $comments = comments::where('pid', $post_id)
            ->orderBy('created_at')
            ->get();

        return response()->json([
                'status' => 'success',
                'data' => $comments
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

        $comment = new comments();

        $comment->comment_text = $data['comment_text'];
        $comment->pid = $data['pid'];
        $comment->user_id = $data['user_id'];
        $comment->save();

        return response()->json([
                'status' => 'success',
                'data' => $comment
            ]
        )->setStatusCode(201);
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

        $comment = comments::find($id);

        if ($comment == null) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $comment
                ]
            )->setStatusCode(404);
        }

        else {
            $comment->comment_text = $data['comment_text'];
            $comment->save();

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $comment
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
        $comment = comments::find($id);

        if ($comment == null) {
            return response()->json([
                    'status' => 'fail',
                    'data' => $comment
                ]
            )->setStatusCode(404);
        }

        else {

            $comment->delete();

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $comment
                ]
            )->setStatusCode(200);
        }
    }
}

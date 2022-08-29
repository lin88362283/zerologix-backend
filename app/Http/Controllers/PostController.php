<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->per_page;
        $posts = Post::paginate($pageSize);
        return $this->sendResponse($posts, 'success');
    }
    /**
     * Display a listing of the favourited resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function favouriteIndex()
    {
        $posts = Post::where('favourited', '=', 1)->get();
        return $this->sendResponse($posts, 'success');
    }


    /**
     * Favourite a specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function favourite($id)
    {
        Post::where('id', $id)->update(['favourited' => 1]);
        $posts = Post::paginate(12);
        return $this->sendResponse($posts, 'success');
    }

    /**
     * Unfavourite a specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function unfavourite($id)
    {
        Post::where('id', $id)->update(['favourited' => 0]);
        $posts = Post::where('favourited', '=', 1)->get();
        return $this->sendResponse($posts, 'success');
    }
}

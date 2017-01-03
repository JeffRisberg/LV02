<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class BlogController extends Controller
{
    public function index()
    {
        $items = Post::all();

        return view("posts", array('posts' => $items));
    }

    public function show($id)
    {
        //return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'title' => 'required',
          'description' => 'required',
        ]);
        $create = Post::create($request->all());
        return response()->json($create);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'title' => 'required',
        'description' => 'required',
      ]);
      $edit = Post::find($id)->update($request->all());
      return response()->json($edit);
    }
    
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json(['done']);
    }
}



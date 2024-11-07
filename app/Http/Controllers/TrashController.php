<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    
    public function index()
    {
        $deletedPosts = Post::onlyTrashed()->get();
        return view('trash.trash', compact('deletedPosts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        
        return redirect()->route('trash')->with('success', 'Post restored successfully!');
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        
        return redirect()->route('trash')->with('success', 'Post permanently deleted!');
    }
}

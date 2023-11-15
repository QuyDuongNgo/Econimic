<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Cache::remember('posts', 60, function () {
            return Post::with('category')->paginate(8);
        });
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|mimes:png,jpg,gif',
            'category_id' => 'required|integer',
            'description' => 'required',
        ]);

        $fileName = time() . '_' . $request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('uploads', $fileName);

        Post::create([
            'title' => $request->title,
            'image' => 'storage/' . $filePath,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $posts = Post::findOrFail($id);
        $categories = Category::all();
        return view('edit', compact('posts', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'description' => 'required',
        ]);
        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:png,jpg,gif',
            ]);

            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('uploads', $fileName);
            $post->image = 'storage/' . $filePath;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;

        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id)->delete();
        return redirect()->route('post.index');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('trashed', compact('posts'));
    }
    public function restore(int $id)
    {
        $posts = Post::onlyTrashed()->findOrFail($id);
        $posts->restore();
        return redirect()->route('post.index');
    }

    public function forceDelete(int $id)
    {
        $posts = Post::onlyTrashed()->findOrFail($id);
        $posts->forceDelete();

        return redirect()->route('post.trashed');
    }
}

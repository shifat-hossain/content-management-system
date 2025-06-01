<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Http\Requests\User\Post\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostTagService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categories')->where('user_id', auth()->id())
            ->paginate(10);
        
        return view('panel.user.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('child_categories')->get();
        return view('panel.user.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->safe()->only([
            'title',
            'slug',
            'description',
            'user_id'
        ]));
        $post->categories()->attach($request->category_ids);
        (new PostTagService())->store($post, $request->tags);
        return redirect()->route('user.posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        ($post->user_id != auth()->user()->id) ?? abort(403, 'Access denied');

        $categories = Category::whereNull('parent_id')->with('child_categories')->get();
        return view('panel.user.posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        ($post->user_id != auth()->user()->id) ?? abort(403, 'Access denied');

        $post->update($request->safe()->only([
            'title',
            'slug',
            'description',
        ]));
        $post->categories()->sync($request->category_ids);
        $post->tags()->delete();
        (new PostTagService())->store($post, $request->tags);

        return redirect()->route('user.posts.index')->with('success', 'Post updated successfully.');
    }

    public function change_status(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $post->update([
            'is_published' => $request->status
        ]);

        return 1;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        ($post->user_id != auth()->user()->id) ?? abort(403, 'Access denied');

        $post->delete();
        return redirect()->route('user.posts.index')->with('success', 'Post approval status updated successfully.');
    }

    public function deleted_posts(Request $request) {
        $deleted_posts = Post::onlyTrashed()->where('user_id', auth()->user()->id)->paginate(10);
        return view('panel.user.posts.deleted_posts', compact('deleted_posts'));
    }

    public function restore($slug) {
        $post = auth()->user()->posts()->withTrashed()->where('slug', $slug)->firstOrFail();
        $post->restore();

        return redirect()->route('user.posts.index')->with('success', 'Post restore successfully.');
    }

    public function permenant_delete($slug)
    {
        $post = auth()->user()->posts()->withTrashed()->where('slug', $slug)->firstOrFail();
        $post->forceDelete();
        return redirect()->route('user.posts.index')->with('success', 'Post permenantly deleted successfully.');
    }
}

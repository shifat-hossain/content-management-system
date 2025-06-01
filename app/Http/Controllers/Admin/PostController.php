<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Jobs\SendEmailApprovalStatus;
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
        $posts = Post::with('categories')->where('is_published', 1)->paginate(10);
        return view('panel.admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('child_categories')->get();
        return view('panel.admin.posts.create', compact('categories'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::whereNull('parent_id')->with('child_categories')->get();
        return view('panel.admin.posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
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

    public function review(Post $post)
    {
        return view('panel.admin.posts.review', compact('post'));
    }

    public function change_approval_status(Post $post, string $status)
    {
        $post->approved_status = $status;
        $post->approved_at = date('Y-m-d H:i:s');
        $post->save();

        SendEmailApprovalStatus::dispatch($post);

        return redirect()->route('admin.posts.index')->with('success', 'Post approval status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post approval status updated successfully.');
    }

    public function deleted_posts(Request $request) {
        $deleted_posts = Post::onlyTrashed()->where('user_id', auth()->user()->id)->paginate(10);
        return view('panel.admin.posts.deleted_posts', compact('deleted_posts'));
    }

    public function restore($slug) {
        $post = Post::withTrashed()->where('slug', $slug)->firstOrFail();
        $post->restore();

        return redirect()->route('admin.posts.index')->with('success', 'Post restore successfully.');
    }
}

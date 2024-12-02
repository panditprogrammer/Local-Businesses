<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    // Index: List all posts
    public function index()
    {
        $posts = Post::latest()->with('category', 'admin')->paginate(25);
        return view('admin.section.post.index', compact('posts'));
    }

    // Create: Show form to create a post
    public function create()
    {
        $data['categories'] = Category::all();
        return view('admin.section.post.create', $data);
    }

    // Store: Save new post
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('posts', "public") : null;

        Post::create([
            'category_id' => $request->category_id,
            'admin_id' => auth("adminGuard")->id(),
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->has('status'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    // Show: Display a single post
    public function show($id)
    {
        return view('admin.section.post.show', compact('post'));
    }

    // Edit: Show form to edit a post
    public function edit($id)
    {
        $data['categories'] = Category::all();
        $post = Post::findOrfail($id);
        $data['post'] = $post;

        if (!$post) {
            return view('admin.section.post.create')->with("error", "Post not found!");
        }
        return view('admin.section.post.edit', $data);
    }


    public function changeStatus($id)
    {
        $post = Post::findOrFail($id);
        if ($post) {
            $post->status = !$post->status;
            $post->save();
            return back()->with("success", "Status changed successfully");
        }

        return redirect()->route('admin.posts.index')->with('error', 'Post not found.');
    }

    // Update: Update a post
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrfail($id);
        if (!$post) {
            return view('admin.section.post.create')->with("error", "Post not found!");
        }

        $imagePath = $post->image;
        if ($request->file('image')) {
            // Delete old image if a new one is uploaded
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk("public")->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('posts', "public");
        }

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->has('status'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    // Destroy: Delete a post
    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        if (!$post) {
            return view('admin.section.post.create')->with("error", "Post not found!");
        }
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk("public")->delete($post->image);
        }
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}

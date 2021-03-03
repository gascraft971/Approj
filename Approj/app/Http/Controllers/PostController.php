<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all posts ordered by the newest first$
        $posts = Post::latest()->get();

        // Pass post collection to view
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == "admin") {
            return view("posts.create");
        }

        return redirect("posts")->with("notification", "You don't have admin access.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == "admin") {
            // Validate posted form data
            $validated = $request->validate([
                "title" => "required|string|unique:posts|min:5|max:100",
                "content" => "required|string|min:5|max:5000",
                "category" => "required|string|max:30"
            ]);

            // Create slug from title
            $validated["slug"] = Str::slug($validated["title"], "-");

            // Create and save post with validated data
            $post = Post::create($validated);

            return redirect(route("posts.show", [$post->slug]))->with("notification", "Post created!");
        }

        return redirect("posts")->with("notification", "You don't have admin access.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Pass current post to view
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (auth()->user()->role == "admin") {
            return view("posts.edit", compact("post"));
        }

        return redirect("posts")->with("notification", "You don't have admin access.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (auth()->user()->role == "admin") {
            // Validate posted form data
            $validated = $request->validate([
                "title" => "required|string|min:5|max:100",
                "content" => "required|string|min:5|max:5000",
                "category" => "required|string|max:30"
            ]);

            // Create slug from title
            $validated["slug"] = Str::slug($validated["title"], "-");

            // Create and save post with validated data
            $post->update($validated);

            return redirect(route("posts.index", [$post->slug]))->with("notification", "Post updated!");
        }

        return redirect("posts")->with("notification", "You don't have admin access.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->role == "admin") {
            // Delete the specified post
            $post->delete();

            // Redirect user with a notification
            return redirect(route("posts.index"))->with("notification", "\"{$post->title}\" deleted!");
        }

        return redirect("posts")->with("notification", "You don't have admin access.");
    }
}

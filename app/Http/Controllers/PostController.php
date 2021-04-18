<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all posts ordered by the newest first (only published posts if guest)
        if (auth()->user() && auth()->user()->role == "admin")
            $posts = Post::latest()->get();
        else
            $posts = Post::where("published", true)->get();

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

        return abort(404);
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
            $validated = $request->validate([]);

            $validated["title"] = "Untitled post";

            // Set basic EditorJS content
            $validated["content"] = '{"time":"' . time() . '","blocks":[],"version":"2.20.2"}';

            // TODO: Change category system
            $validated["category"] = "CSS";

            // TODO: Add image change option in editor
            $validated["image"] = "https://via.placeholder.com/750x450";

            // Create slug from title
            $validated["slug"] = rand(0, 100000000) . "-" . Str::slug($validated["title"], "-");

            // Create UUID
            $validated["uuid"] = Str::uuid();

            // Create and save post with validated data
            $post = Post::create($validated);

            return redirect(route("posts.show", [$post->slug]))->with("notification", "Post created!");
        }

        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->published) {
            // Pass current post to view
            return view("posts.show", compact("post"));
        }
        
        return abort(404);
    }

    /**
     * Display a preview of a post
     *
     * @param  UUID $uuid
     * @return \Illuminate\Http\Response
     */
    public function preview($uuid)
    {
        if (auth()->user()->role == "admin") {
            $post = Post::where("uuid", $uuid)->get()[0];
            return view("posts.show", ["post" => $post, "previewMode" => true]);
        }

        return abort(404);
    }

    /**
     * Make the resource public
     *
     * @param  UUID $uuid
     * @return \Illuminate\Http\Response
     */
    public function publish($uuid)
    {
        if (auth()->user()->role == "admin") {
            $post = Post::where("uuid", $uuid)->get()[0];

            $id = $post->id;
            DB::update("UPDATE posts SET `published` = ?, `published_at` = ? WHERE id = ?", [true, \Carbon\Carbon::now(), $id]);
        }
        else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UUID $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        if (auth()->user()->role == "admin") {
            $post = Post::where("uuid", $uuid)->get()[0];
            return view("posts.edit", compact("post"));
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        if (auth()->user()->role == "admin") {
            $post = Post::where("uuid", $uuid)->get()[0];
            // Validate posted form data
            $validated = $request->validate([
                "title" => "required|string|min:5|max:100",
                "content" => "required|string|min:5|max:5000",
                "category" => "string|max:30"
            ]);

            if($validated["category"] == "") {
                $validated["category"] = "CSS";
            }

            // Create slug from title
            $validated["slug"] = rand(0, 100000000) . "-" . Str::slug($validated["title"], "-");

            // Create and save post with validated data
            $post->update($validated);
        }
        else {
            return abort(404);
        }
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

        return abort(404);
    }
}

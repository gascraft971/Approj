<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * Upload an image
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function file(Request $request) {
        $validated = $request->validate([
            "image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:4096",
        ]);

        $image = $validated["image"];
        
        $name = "image_" . Str::uuid() . "." . $image->getClientOriginalExtension();
        $destination = public_path("uploads/images");
        $path = $image->move($destination, $name);
        
        // Save image to database
        $image = Image::create(["name" => $name]);
        $url = "uploads/images/" . $image->name;

        // Return response to EditorJS
        $response = ["success" => 1, "file" => ["url" => $url]];
        return $response;
    }

    /**
     * Upload an image from a URL
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function url(Request $request) {
        $validated = $request->validate([
            "url" => "required|url",
        ]);

        $url = $validated["url"];
        
        $extension = explode(".", $url)[-1];
        $name = "image_" . Str::uuid() . "." . $extension;

        $destination = public_path("uploads/images/") . $name;
        $path = file_put_contents($destinationPath, file_get_contents($url));
        
        return $path; // TODO: Finish this, it probably doesn't work
    }
}
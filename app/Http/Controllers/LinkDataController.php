<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkDataController extends Controller
{
    /**
     * Get meta tags of a given URL
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $validated = $request->validate([
            "url" => "required|url",
        ]);

        $meta = get_meta_tags($validated["url"]);
        $response = ["success" => 1, "meta" => []];

        // Retrieve page title
        $data = file_get_contents($validated["url"]);
        $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
        $response["meta"]["title"] = html_entity_decode($title);

        // Retrieve page description, if it exists
        if (isset($meta["description"]))
            $response["meta"]["description"] = html_entity_decode($meta["description"]);
        
        if (isset($meta["image"])) {
            $response["meta"]["image"] = [];
            $response["meta"]["image"]["url"] = $meta["image"];
        }
        return $response;
    }
}

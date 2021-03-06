<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    // Set mass-assignable fields
    protected $fillable = ["title", "content", "category", "image", "slug", "uuid"];

    /**
     * Get the route keyfor the model
     * @return string
     */
    public function getRouteKeyName() {
        return "slug";
    }
}

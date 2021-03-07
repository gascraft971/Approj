<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Set mass-assignable fields
    protected $fillable = ["title", "content", "category", "image", "slug"];

    /**
     * Get the route keyfor the model
     * @return string
     */
    public function getRouteKeyName() {
        return "slug";
    }
}

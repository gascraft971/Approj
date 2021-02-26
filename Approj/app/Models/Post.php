<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Set mass-assignable fields
    protected $fillable = ["title", "content", "category", "slug"];
}

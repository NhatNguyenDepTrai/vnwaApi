<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryBlog;
use App\Models\Blog;
use App\Models\BlogTag;

class Process extends Model
{
    use HasFactory;
    protected $fillable = ['url_avatar', 'url_avatar_mobile', 'name', 'desc'];
}

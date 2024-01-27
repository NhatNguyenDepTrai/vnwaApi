<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;
    protected $fillable = ['url_avatar', 'url_avatar_mobile', 'name', 'slug', 'desc', 'meta_title', 'meta_image', 'meta_desc'];
}

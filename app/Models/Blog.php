<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id_category_blog', 'url_bg', 'url_avatar', 'url_avatar_mobile', 'name', 'slug', 'desc', 'content', 'meta_title', 'meta_image', 'meta_desc'];
    public function listImages()
    {
        return $this->hasMany(ListImage::class, 'id_tb')->where('tb', 'blogs');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'list_blog_tags', 'id_blog', 'id_blog_tag');
    }
    public function categoryBlog()
    {
        return $this->belongsTo(CategoryBlog::class, 'id_category_blog');
    }
}

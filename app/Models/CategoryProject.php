<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoryProject extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['url_bg', 'url_avatar', 'url_avatar_mobile', 'name', 'slug', 'desc', 'meta_title', 'content', 'meta_image', 'meta_desc'];
    public function listImages()
    {
        return $this->hasMany(ListImage::class, 'id_tb')->where('tb', 'category_projects');
    }
}

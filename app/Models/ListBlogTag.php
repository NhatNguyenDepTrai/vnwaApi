<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBlogTag extends Model
{
    use HasFactory;
    protected $fillable = ['id_blog_tag', 'id_blog'];
}

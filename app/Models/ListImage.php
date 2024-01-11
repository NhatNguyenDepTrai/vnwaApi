<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListImage extends Model
{
    use HasFactory;
    protected $fillable = ['tb', 'id_tb', 'url_image'];

    // public function categoryProject()
    // {
    //     return $this->belongsTo(CategoryProject::class, 'id_tb');
    // }
    public function relatedTable()
    {
        return $this->morphTo('tb', 'id_tb');
    }
}

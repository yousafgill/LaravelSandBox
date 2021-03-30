<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    public function Post(){
        return $this->belongsTo('App\Models\Post','post_id','id');
    }
    public function Category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    protected $fillable = [
        'post_id',
        'category_id',
    ];
}

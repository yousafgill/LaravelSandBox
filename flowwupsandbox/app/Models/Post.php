<?php

namespace App\Models;
use App\Models\status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function status(){
        return $this->belongsTo('App\Models\status','status_id','id');
    }

    protected $fillable = [
        'board_id',
        'user_id',
        'status_id',
        'owner_id',
        'category_id',
        'title',
        'slug','detail','public_url','is_spam','votes','estimated',
        'status_color'
    ];
  
}

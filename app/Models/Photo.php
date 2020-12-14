<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';

    public function getUserAttribute(){
        return $this->attributes['user'] = User::find($this->user_id);
    }

    public function getCategoryAttribute(){
        return $this->attributes['category'] = Category::find($this->category_id);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    protected $appends = ['user', 'category'];
}

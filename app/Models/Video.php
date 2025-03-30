<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'file_path', 'thumbnail','cover_image','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'video_category');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
    
    public function isLikedByUser() {
        return auth()->check() && $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public static function getLatestVideos($limit = 9)
    {
        return self::latest()->take($limit)->get();
    }
}

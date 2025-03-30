<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $videoId)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Bạn cần đăng nhập để bình luận'], 401);
    }

    $video = Video::find($videoId);
    if (!$video) {
        return response()->json(['error' => 'Video không tồn tại'], 404);
    }

    $request->validate([
        'comment' => 'required|string|max:500' // Sửa 'content' thành 'comment'
    ]);

    $comment = Comment::create([
        'user_id' => Auth::id(),
        'video_id' => $videoId,
        'comment' => $request->comment // Sử dụng đúng tên cột trong database
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Bình luận đã được đăng!',
        'comment' => [
            'user' => Auth::user()->name,
            'comment' => $comment->comment // Trả về đúng tên cột
        ]
    ]);
}

    
}

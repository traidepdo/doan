<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Video;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $videoId) {
        $user = auth()->user(); // Lấy user đang đăng nhập
        $video = Video::findOrFail($videoId); // Lấy video theo ID

        // Kiểm tra user đã like video này chưa
        $existingLike = Like::where('user_id', $user->id)
                            ->where('video_id', $videoId)
                            ->first();

        if ($existingLike) {
            // Nếu user đã like, thì xóa like (Unlike)
            $existingLike->delete();
            return response()->json([
                'success' => true, 
                'liked' => false, 
                'likes' => $video->likes()->count()
            ]);
        } else {
            // Nếu chưa like, thì tạo like mới
            Like::create([
                'user_id' => $user->id, 
                'video_id' => $videoId
            ]);

            return response()->json([
                'success' => true, 
                'liked' => true, 
                'likes' => $video->likes()->count()
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class HomeController extends Controller
{
    // Hiển thị trang chủ với danh sách video
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('user.home', compact('videos'));
    }
    public function getLatestVideos($limit = 9)
    {
        return Video::latest()->take($limit)->get();
    }
    // Hiển thị trang xem phim
    public function watch($id)
    {
        $video = Video::findOrFail($id);
        return view('user.watch', compact('video'));
    }
}


<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm video theo tiêu đề
        $videos = Video::where('title', 'LIKE', "%{$query}%")->paginate(10);

        return view('user.search', compact('videos', 'query'));
    }
}

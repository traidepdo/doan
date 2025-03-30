<?php



namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    
    public function dashboard()
    {
        return view('admin.dashboard'); // Đảm bảo bạn có file `dashboard.blade.php` trong `resources/views/admin/`
    }
    
    // Hiển thị danh sách video
    public function index()
    {
        $videos = Video::with('categories')->get();
        return view('admin.videos.index', compact('videos'));
    }

    // Hiển thị form thêm video
    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create', compact('categories'));
    }

    // Lưu video mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|mimes:mp4,mov,avi|max:20000',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_ids' => 'array|exists:categories,id',
        ]);
    
        // Lưu file video
        $videoPath = $request->file('video')->store('videos', 'public');
    
        // Lưu ảnh thumbnail nếu có
        $thumbnailPath = $request->hasFile('thumbnail') 
            ? $request->file('thumbnail')->store('thumbnails', 'public') 
            : null;
    
        // Lưu ảnh bìa nếu có
        $coverImagePath = $request->hasFile('cover_image') 
            ? $request->file('cover_image')->store('covers', 'public') 
            : null;
    
        // Lấy ID của admin đăng nhập
        $adminId = Auth::id(); 
    
        // Tạo video
        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $videoPath,
            'thumbnail' => $thumbnailPath,
            'cover_image' => $coverImagePath,
            'user_id' => $adminId, // Lưu ID admin đăng video
        ]);
    
        // Gán thể loại cho video
        $video->categories()->attach($request->category_ids);
    
        return redirect()->route('admin.videos.index')->with('success', 'Thêm video thành công!');
    }
    

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $categories = Category::all();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    
    // Cập nhật video
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Cập nhật tiêu đề
        $video->title = $request->title;

        // Cập nhật thumbnail nếu có
        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $video->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Cập nhật ảnh bìa nếu có
        if ($request->hasFile('cover_image')) {
            if ($video->cover_image) {
                Storage::disk('public')->delete($video->cover_image);
            }
            $video->cover_image = $request->file('cover_image')->store('covers', 'public');
        }

        $video->save();

        return redirect()->route('admin.videos.index')->with('success', 'Cập nhật video thành công.');
    }

    // Xóa video
    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        // Xóa file video, thumbnail và ảnh bìa nếu có
        if ($video->file_path) {
            Storage::disk('public')->delete($video->file_path);
        }
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        if ($video->cover_image) {
            Storage::disk('public')->delete($video->cover_image);
        }

        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Xóa video thành công.');
    }
}

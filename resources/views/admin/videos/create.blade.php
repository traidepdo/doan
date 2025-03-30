@extends('layouts.admin')

@section('content')
    <h1>Thêm Video Mới</h1>
    
    <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề Video</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề video" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả Video</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả video" required></textarea>
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <input type="file" name="video" id="video" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ảnh bìa</label>
            <input type="file" name="cover_image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Chọn Thể Loại</label>
            <select name="category_ids[]" id="categories" class="form-control" multiple required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu Video</button>
    </form>
@endsection

@extends('layouts.admin')

@section('content')
    <h1>Chỉnh Sửa Video</h1>

    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề Video</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề video" value="{{ old('title', $video->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả Video</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả video" required>{{ old('description', $video->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Video (Chọn Video Mới)</label>
            <input type="file" name="video" id="video" class="form-control">
            <small class="text-muted">Nếu không thay đổi video, để trống trường này.</small>
        </div>
        <div class="mb-3">
            <label>Ảnh bìa (nếu có)</label>
            <input type="file" name="cover_image" class="form-control">
            @if($video->cover_image)
                <img src="{{ asset('storage/' . $video->cover_image) }}" width="100">
            @endif
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Chọn Thể Loại</label>
            <select name="category_ids[]" id="categories" class="form-control" multiple required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if(in_array($category->id, $video->categories->pluck('id')->toArray())) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập Nhật Video</button>
    </form>
@endsection

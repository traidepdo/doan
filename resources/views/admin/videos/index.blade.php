<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('asset/admin/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Admin</title>
</head>

<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                <div class="sidebar-top">
                    <i class="ri-user-settings-line"></i>
                    <span>Admin</span>
                </div>
                <div class="sidebar-content">
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}"><i class="ri-dashboard-line"></i> Dashboard <i class="ri-add-box-line"></i></a>
                        </li>
                        <li>
                            <a href="#"> <i class="ri-folder-video-line"></i> Quản lý video <i class="ri-add-box-line"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.videos.index') }}"><i class="ri-arrow-left-s-fill"></i> Danh sách video</a></li>
                                <li><a href="{{ route('admin.videos.create') }}"><i class="ri-arrow-left-s-fill"></i> Thêm</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="admin-content">
                <div class="content-top">
                    <!-- Hiển thị tên người dùng -->
                    @if (Auth::check())
                        <p>{{ Auth::user()->name }}</p>
                        <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Đăng xuất
                        </a>

                        <!-- Form logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <p>Bạn chưa đăng nhập. <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
                    @endif
                </div>
                <div class="admin-main">
                    <div class="admin-main-title">
                        <h1>Danh sách Video</h1>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>VIdeo</th>
                                <th>Image</th>
                                <th>Thời gian</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos as $video)
                            <tr>
                                <td>{{ $video->id }}</td>
                                <td>{{ $video->title }}</td>
                                <td>
                                    <video width="200px" height="auto" controls>
                                        <source src="{{ Storage::url('/' . $video->file_path) }}" type="video/mp4">
                                    </video></td>
                                <td>
                                    @if($video->cover_image)
                                        <img src="{{ asset('storage/' . $video->cover_image) }}" width="80">
                                    @else
                                        <span>Không có</span>
                                    @endif
                                </td>
                                <td>{{ $video->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-warning">Sửa</a>
                                    <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
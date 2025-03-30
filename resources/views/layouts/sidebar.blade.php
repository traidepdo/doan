<aside class="w-64 bg-gray-900 text-white h-screen fixed">
    <div class="p-4">
        <h2 class="text-xl font-semibold">Admin Menu</h2>
    </div>
    <ul class="mt-4 space-y-2">
        <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a></li>
        <li><a href="{{ route('admin.videos.index') }}" class="block px-4 py-2 hover:bg-gray-700">Quản lý Video</a></li>
        <li><a href="{{ route('admin.videos.create') }}" class="block px-4 py-2 hover:bg-gray-700">Người dùng</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-red-700">Đăng xuất</button>
            </form>
        </li>
    </ul>
</aside>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('asset/user/style.css')}}">
    <script src="{{asset('asset/user/scrips.js')}}"></script>
    <title>Giao diện web</title>
</head>

<body>
    <div class="overlay"></div>
    <header>
        <div class="container top">
            <div class="row-flex">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" id="closeButton">
                        <i class="ri-menu-line"></i>
                    </a>
                    <a href="#">About</a>
                    <a href="#">Services</a>
                    <a href="#">Clients</a>
                    <a href="#">Contact</a>
                </div>

                <!-- Use any element to open the sidenav -->
                <span class="home" id="menuButton">
                    <i class="ri-menu-line"></i>
                </span>

                <div class="header-logo">

                    <img src="{{asset('asset/image/images.png')}}" alt="">
                </div>
                <div class="header-search">
                        <form action="{{ route('user.search') }}" method="GET">
                            <input type="text" name="query" placeholder="Tìm kiếm...">
                            <button type="submit"><i class="ri-search-line"></i></button>
                        </form>
                </div>
                <div class="header-cart">
                    <i class="ri-shopping-cart-fill"></i>
                </div>
            </div>
        </div>
    </header>
    <section class="search-video">
    
        <div class="container">
        <h2>Kết quả tìm kiếm cho: "{{ $query }}"</h2>
            <div class="row-flex">
                
                @if($videos->count() > 0)
                <div class="list-video">
                    @foreach($videos as $video)
                        <div class="video">
                            <a href="{{ route('watch', $video->id) }}">
                                <img src="{{ asset('storage/' . $video->cover_image) }}" alt="Cover Image">
                            </a>
                            <p>{{ $video->title }}</p>
                        </div>
                    @endforeach
                    </div>
                    {{ $videos->links() }} <!-- Hiển thị phân trang -->
                @else
                    <p>Không tìm thấy kết quả nào.</p>
                @endif
            </div>
        </div>
    </section>
    <script src="{{asset('asset/user/scrips.js')}}"></script>
</body>

</html>

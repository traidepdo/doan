<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="video-detail">
        <div class="container">
            <div class="row-grid">
                <div class="video">
                    <div class="video-item">    
                            <video width="200px" height="auto" controls>
                                <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                            </video>
                    </div>
                    <div class="detail">
                        <h1 class="title">{{ $video->title }}</h1>
                        <p class="card-text">Người đăng: {{ $video->user->name ?? 'Admin' }}</p>
                    <button id="like-btn-{{ $video->id }}" onclick="likeVideo({{ $video->id }})">
                        👍 <span id="like-text-{{ $video->id }}">{{ $video->isLikedByUser() ? 'Unlike' : 'Like' }}</span> 
                        (<span id="like-count-{{ $video->id }}">{{ $video->likes()->count() }}</span>)
                    </button>


                    </div>
                    <div class="comments">
                        <h3>Bình luận</h3>

                        <div id="comment-list">
                            @foreach ($video->comments as $comment)
                                <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                            @endforeach
                        </div>

                        @auth
                            <div class="comment-form">
                                <textarea id="comment-content" placeholder="Viết bình luận..." rows="3"></textarea>
                                <button onclick="postComment({{ $video->id }})">Gửi</button>
                            </div>
                        @else
                            <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận.</p>
                        @endauth
                    </div>

                </div>
                <div class="list-video">
                        @foreach(app('App\Http\Controllers\HomeController')->getLatestVideos() as $latestVideo)
                            <div class="video-item">
                                <img src="{{ asset('storage/' . $latestVideo->cover_image) }}" alt="Cover Image">
                                <span>{{ $latestVideo->title }}</span>
                            </div>
                        @endforeach
                </div>
            </div>
                
        </div>
    </div>
    <script>
        function likeVideo(videoId) {
            let likeButton = document.getElementById(`like-btn-${videoId}`);
            let likeText = document.getElementById(`like-text-${videoId}`);
            let likeCount = document.getElementById(`like-count-${videoId}`);

            if (!likeButton || !likeText || !likeCount) {
                console.error("Nút like hoặc bộ đếm like không tồn tại!");
                return;
            }

            fetch(`/video/${videoId}/like`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    likeText.textContent = data.liked ? "Unlike" : "Like";
                    likeCount.textContent = data.likes;
                } else {
                    alert("Có lỗi xảy ra!");
                }
            })
            .catch(error => console.error("Lỗi:", error));
        }

function postComment(videoId) {
    let comment = document.getElementById('comment-content').value;

    fetch(`/video/${videoId}/comment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ comment: comment }) // Sửa 'content' thành 'comment'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert("Lỗi: " + data.error);
        }
    })
    .catch(error => {
        console.error("Lỗi:", error);
        alert("Có lỗi xảy ra, kiểm tra console!");
    });
}


    </script>
</body>

</html>
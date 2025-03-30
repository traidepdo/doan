document.addEventListener("DOMContentLoaded", function() {
    let currentIndex = 0;
    const slides = document.querySelector(".slider");
    const slideItems = document.querySelectorAll(".slide");
    const slidesPerView = 3; // Số ảnh hiển thị cùng lúc
    const totalSlides = slideItems.length;
    const totalGroups = Math.ceil(totalSlides / slidesPerView);

    if (slides && slideItems.length > 0) {
        function showSlide(index) {
            if (index >= totalGroups) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = totalGroups - 1;
            } else {
                currentIndex = index;
            }

            let slideWidth = slideItems[0].offsetWidth; // Lấy kích thước của một ảnh
            let offset = -currentIndex * slideWidth * slidesPerView;
            slides.style.transform = `translateX(${offset}px)`;
        }

        window.nextSlide = function() {
            showSlide(currentIndex + 1);
        };

        window.prevSlide = function() {
            showSlide(currentIndex - 1);
        };

        // Tự động chuyển ảnh sau mỗi 5 giây
        setInterval(window.nextSlide, 5000);
    }
});


document.addEventListener("DOMContentLoaded", function() {
    let home = document.getElementById("menuButton");
    let overlay = document.querySelector('.overlay');
    let sidenav = document.getElementById("mySidenav");
    let closeBtn = document.getElementById("closeButton");

    function openNav() {
        sidenav.style.width = "152px";
        home.style.visibility = "hidden";
        overlay.style.display = "block";
    }

    function closeNav() {
        sidenav.style.width = "0";
        home.style.visibility = "visible";
        overlay.style.display = "none";
    }

    home.addEventListener("click", openNav);
    closeBtn.addEventListener("click", closeNav);
});


// document.addEventListener("DOMContentLoaded", function() {
//     let home = document.querySelector('.home');
//     let overlay = document.querySelector('.overlay');
//     let sidenav = document.getElementById("mySidenav");

//     function openNav() {
//         sidenav.style.width = "152px";
//         home.style.visibility = "hidden";
//         overlay.style.display = "block";
//     }

//     function closeNav() {
//         sidenav.style.width = "0";
//         home.style.visibility = "visible";
//         overlay.style.display = "none";
//     }

//     document.querySelector(".home").addEventListener("click", openNav);
//     document.querySelector(".closebtn").addEventListener("click", closeNav);
// });
// nav
// let home = document.querySelector('.home')
// let overlay = document.querySelector('.overlay');

// function openNav() {
//     document.getElementById("mySidenav").style.width = "152px";
//     home.style.visibility = "hidden"; //ẩn nút home
//     overlay.style.display = "block"; // Làm mờ trang

// }

// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0px";
//     home.style.visibility = "visible";
//     overlay.style.display = "none"; // Xóa Làm mờ trang
// }
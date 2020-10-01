<div class="navbar-full">
    <div class="container navbar-block">
        <div class="row">
            <a href="" class="logo">
                <img src="<?php echo base_url() ?>vendor/img/order-food-64.png">
                <span>SSM</span>
            </a>
            <nav>
                <ul class="navbar">
                    <li class="navbar__menu"><a href="">Trang chủ</a></li>
                    <li class="navbar__menu"><a href="">Sản phẩm</a></li>
                    <li class="navbar__menu"><a href="">Tin tức</a></li>
                    <li class="navbar__menu"><a href="">Ưu đãi thành viên</a></li>
                    <li class="navbar__menu"><a href="">Tuyển dụng</a></li>
                    <li class="navbar__menu"><a href="">Cửa hàng</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    document.querySelector('body').onscroll = function() {
        var logoElement = document.querySelector('header .logo');
        var textNavbarElements = document.querySelectorAll('header nav .navbar .navbar__menu a');
        var navbarFullElement = document.querySelector('header .navbar-full');
        if (window.scrollY >= 100) {
            logoElement.classList.add('navbar-text-color');
            for (element of textNavbarElements) {
                element.classList.add('navbar-text-color');
            }
            navbarFullElement.classList.add('background-color');
        } else {
            logoElement.classList.remove('navbar-text-color');
            for (element of textNavbarElements) {
                element.classList.remove('navbar-text-color');
            }
            navbarFullElement.classList.remove('background-color');
        }
    }
</script>
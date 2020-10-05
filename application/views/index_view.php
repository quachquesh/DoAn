<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Smart Sales Manager</title>
	<link rel="icon" href="<?php echo base_url() ?>vendor/img/order-food-32.png">
	<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/css/grid.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/css/main.css">
</head>
<body>

	<div class="modal">
		<div class="modal__overlay"></div>
		<div class="modal__box">
			<div class="modal__box-header">
				<div class="modal__box-header-select">
					<div class="log-in active">Đăng nhập</div>
					<div class="sign-in">Đăng ký</div>
				</div>
			</div>
			<div class="modal__box-form">
				<form id="form-login">
					<div class="inputBox">
						<input type="email" name="email" required>
						<label>Email</label>
					</div>
					<div class="inputBox">
						<input type="password" name="password" required>
						<label>Mật khẩu</label>
					</div>
					<span class="error-message"></span>
					<input type="button" value="Đăng nhập">
				</form>
				<form id="form-signin" action="" method="POST">
					<div class="inputBox">
						<input type="text" name="fullname" required="">
						<label>Họ và tên</label>
					</div>
					<div class="inputBox">
						<input type="text" name="email" required="">
						<label>Email</label>
					</div>
					<div class="inputBox">
						<input type="password" name="password" required="">
						<label>Mật khẩu</label>
					</div>
					<span class="error-message"></span>
					<input type="button" value="Đăng ký">
				</form>
			</div>
		</div>
	</div>

	<header>
		<div class="navbar-full">
			<div class="grid wide navbar-block">
				<div class="row navbar-list">
					<a href="" class="logo">
						<img src="<?php echo base_url() ?>vendor/img/order-food-64.png">
						<span>SSM</span>
					</a>
					<nav>
						<ul class="navbar">
							<li class="navbar__menu active"><a class="navbar__menu-item" href="">Trang chủ</a></li>
							<li class="navbar__menu"><a class="navbar__menu-item" href="">Sản phẩm</a></li>
							<li class="navbar__menu"><a class="navbar__menu-item" href="">Ưu đãi thành viên</a></li>
							<li class="navbar__menu"><a class="navbar__menu-item" href="">Tuyển dụng</a></li>
							<li class="navbar__menu"><a class="navbar__menu-item" href="">Cửa hàng</a></li>
							<?php if (empty($this->session->userdata('email')) == 1): ?>
								<li class="navbar__menu account">
								<svg
									xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px">
									<path d="M0 0h24v24H0z" fill="none"/>
									<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
								</svg>
								</li>
							<?php endif ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div class="nav-background">
			<img class="nav-background__img" src="<?php base_url(); ?>vendor/img/store_master.jpg" alt="">
		</div>
	</header>

	<div class="container">
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<div>asd</div>
		<form action="api/Logout" method="POST">
			<input type="submit" name="submit" value="Đăng xuất" style="padding: 10px 15px; background-color: red; border: none; outline: none; font-size: 1.8rem; font-weight: 500; cursor: pointer;">
		</form>
	</div>

	<footer>
		
	</footer>

	<script type="text/javascript" src="<?php echo base_url(); ?>vendor/js/jquery-3.5.1.min.js"></script>

	<script>
		var accountElement = document.querySelector('.account svg');
		if (window.scrollY >= 100) {
			var logoElement = document.querySelector('header .logo');
			var textNavbarElements = document.querySelectorAll('header nav .navbar .navbar__menu a');
			var navbarFullElement = document.querySelector('header .navbar-full');
			logoElement.classList.add('navbar-text-color');
			for (element of textNavbarElements) {
				element.classList.add('navbar-text-color');
			}
			navbarFullElement.classList.add('background-color');
			accountElement.style.fill = 'black';
		}
		document.querySelector('body').onscroll = function() {
			var logoElement = document.querySelector('header .logo');
			var textNavbarElements = document.querySelectorAll('header nav .navbar .navbar__menu a');
			var navbarFullElement = document.querySelector('header .navbar-full');
			var accountElement = document.querySelector('.account svg');
			if (window.scrollY >= 100) {
				logoElement.classList.add('navbar-text-color');
				for (element of textNavbarElements) {
					element.classList.add('navbar-text-color');
				}
				navbarFullElement.classList.add('background-color');
				accountElement.style.fill = 'black';
			} else {
				logoElement.classList.remove('navbar-text-color');
				for (element of textNavbarElements) {
					element.classList.remove('navbar-text-color');
				}
				navbarFullElement.classList.remove('background-color');
				accountElement.style.fill = 'white';
			}
		}

		// Animation FORM Đăng ký/Đăng nhập

		accountElement.onclick = function() {
			document.querySelector('.modal').classList.add('active');
			document.querySelector('body').style.overflow = "hidden";
		}

		document.querySelector('.modal__overlay').onclick = function() {
			document.querySelector('.modal').classList.remove('active');
			document.querySelector('body').style.overflow = "unset";
		}

		var modalBoxElement = document.querySelector('.modal__box');
		var btnLoginElement = document.querySelector('.modal__box-header-select .log-in');
		var btnSigninElement = document.querySelector('.modal__box-header-select .sign-in');
		var formLoginElement = document.querySelector('#form-login');
		var formSigninElement = document.querySelector('#form-signin');
		btnLoginElement.onclick = function() {
			this.classList.add('active');
			btnSigninElement.classList.remove('active');
			formLoginElement.style.transform = "translateX(-50%)";
			formSigninElement.style.transform = "translateX(-200%)";
			modalBoxElement.style.height = "360px";
		}
		btnSigninElement.onclick = function() {
			this.classList.add('active');
			btnLoginElement.classList.remove('active');
			formLoginElement.style.transform = "translateX(100%)";
			formSigninElement.style.transform = "translateX(-50%)";
			modalBoxElement.style.height = "430px";
		}

		
		var btnLogin = document.querySelector('#form-login input[type="button"]');
		btnLogin.onclick = function() {
			console.log("loading...");
			$.ajax({
				url: 'api/Login',
				type: 'POST',
				dataType: 'json',
				data: {
					email: document.querySelector('#form-login input[name="email"]').value,
					password: document.querySelector('#form-login input[name="password"]').value
				},
			})
			.done(function(data) {
				location.reload();
			})
			.fail(function(data) {
				document.querySelector('#form-login .error-message').innerText = data.responseJSON.message;
			})
			.always(function() {
				console.log("complete");
			});
		};
	</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administration Manager</title>
	<link rel="icon" href="/vendor/img/order-food-32.png">
	<link rel="stylesheet" href="/vendor/css/admin.css">
	<link rel="stylesheet" href="/vendor/css/grid.css">
</head>
<body>

	<div class="loading-page">
		<svg>
			<circle cx="70" cy="70" r="70"></circle>
		</svg>
	</div>

	<div class="app-container">
		<div class="app-header">
			<div class="app-header__logo">
				<div class="logo-src">
					<img src="/vendor/img/order-food-64.png" width="48px">
					<span>SSM <span style="font-size: 14px;">Manager</span></span>
				</div>
				<div class="header__pane showbar">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>

			<div class="app-header__content">
				<div class="content-left">
					<!-- <div class="header-setting">setting</div> -->
				</div>
				<div class="content-right">
					<div class="header-user">
						<div class="user-avt">
							<div class="user-pane">
								<div class="user__logo" style="background-image: url(/vendor/img/account-black.svg);"></div>
								<div class="arrow-down"></div>
							</div>
							<div class="user-silebar">
								<ul>
									<li class="lidebar-items">Thông tin cá nhân</li>
									<li class="lidebar-items">Đổi mật khẩu</li>
									<li class="lidebar-items" id="btnLogout">Đăng xuất</li>
								</ul>
							</div>
						</div>
						<div class="user__info">
							<div class="user-name"><?php echo $this->session->userdata('firstName') . " " . $this->session->userdata('lastName') ?></div>
							<div class="user-level"><?php echo $this->session->userdata('duty'); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="app-main">
			<div class="app-slidebar">
				<div class="app-slidebar__inner">
					<ul class="nav-menu">
						<li>
							<div class="nav-menu__title slidebar-btn active">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/dashboard-black-18dp.svg)"></div>
									DashBoard
								</div>
							</div>
						</li>
						<li>
							<div class="nav-menu__title slidebar-btn">
								<div id="account-manager" class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/person-black-18dp.svg)"></div>
									Quản lý tài khoản
								</div>
							</div>
						</li>
						<li>
							<div class="nav-menu__title dropdown-mm">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/grade-black-18dp.svg)"></div>
									Menu 1
								</div>
								<div class="nav-menu__title-icon"></div>
							</div>
							<div class="mini-menu">
								<ul class="mm-collapse">
									<li><a>mini menu 1</a></li>
									<li><a>mini menu 2</a></li>
									<li><a>mini menu 3</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="nav-menu__title dropdown-mm">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/grade-black-18dp.svg)"></div>
									Menu 1
								</div>
								<div class="nav-menu__title-icon"></div>
							</div>
							<div class="mini-menu">
								<ul class="mm-collapse">
									<li><a>mini menu 1</a></li>
									<li><a>mini menu 2</a></li>
									<li><a>mini menu 3</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="nav-menu__title slidebar-btn">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/grade-black-18dp.svg)"></div>
									DashBoard
								</div>
							</div>
						</li>
						<li>
							<div class="nav-menu__title dropdown-mm">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/grade-black-18dp.svg)"></div>
									Menu 1
								</div>
								<div class="nav-menu__title-icon"></div>
							</div>
							<div class="mini-menu">
								<ul class="mm-collapse">
									<li><a>mini menu 1</a></li>
									<li><a>mini menu 2</a></li>
									<li><a>mini menu 3</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="nav-menu__title dropdown-mm">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/grade-black-18dp.svg)"></div>
									Menu 1
								</div>
								<div class="nav-menu__title-icon"></div>
							</div>
							<div class="mini-menu">
								<ul class="mm-collapse">
									<li><a>mini menu 1</a></li>
									<li><a>mini menu 2</a></li>
									<li><a>mini menu 3</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="nav-menu__title dropdown-mm">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/grade-black-18dp.svg)"></div>
									Menu 1
								</div>
								<div class="nav-menu__title-icon"></div>
							</div>
							<div class="mini-menu">
								<ul class="mm-collapse">
									<li><a>mini menu 1</a></li>
									<li><a>mini menu 2</a></li>
									<li><a>mini menu 3</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="nav-menu__title dropdown-mm">
								<div class="nav-menu__title-name">
									<div class="icon-menu" style="background-image: url(/vendor/img/grade-black-18dp.svg)"></div>
									Menu 1
								</div>
								<div class="nav-menu__title-icon"></div>
							</div>
							<div class="mini-menu">
								<ul class="mm-collapse">
									<li><a>mini menu 1</a></li>
									<li><a>mini menu 2</a></li>
									<li><a>mini menu 3</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="app-main__outer">
				<div class="app-main__inner" id="app-main__inner">
					<div class="inner__header">
						<div class="inner__title-icon">
							<div class="icon-img" style="background-image: url(/vendor/img/dashboard-black-18dp.svg);"></div>
						</div>
						<div class="inner__header-text">
							<div class="inner__header-text-title">
								Bảng điều khiển
							</div>
							<div class="inner__header-text-content">
								Quản lý các thay đổi
							</div>
						</div>
					</div>
					<!-- <div class="inner__button">
						<div class="btn btn-trans active">
							Tạo tài khoản
						</div>
						<div class="btn btn-trans">
							Tài khoản admin
						</div>
						<div class="btn btn-trans">
							Tài khoản khách
						</div>
					</div> -->
					<div class="inner__body">
						<div class="create-account inner__body-card row no-gutters">
							<div class="col c-12 m-8 m-o-2 l-6 l-o-3">
								<div class="card card-block">
									<div class="card-body">
										<h1>Coming soon...</h1>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="message-box" id="message-box">
		<div class="message-box__overlay"></div>
		<div class="message-body">
			<h2 class="message-body__title"></h2>
			<div class="message-body__content"></div>
			<div class="message-body__button btn"></div>
		</div>
	</div>

	<script type="text/javascript" src="/vendor/js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="/vendor/js/app-admin.js"></script>

	<script>
		
	</script>
</body>
</html>
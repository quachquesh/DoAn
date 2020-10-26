<div class="app-slidebar">
	<div class="app-slidebar__inner">
		<ul class="nav-menu">
			<li>
				<div id="DashBoard" class="nav-menu__title slidebar-btn active">
					<div class="nav-menu__title-name">
						<div class="icon-menu material-icons">dashboard</div>
						DashBoard
					</div>
				</div>
			</li>
			<?php if ($this->session->userdata('accountManager')): ?>
			<li>
				<div id="AccountManager" class="nav-menu__title slidebar-btn">
					<div  class="nav-menu__title-name">
						<div class="icon-menu material-icons">people_alt</div>
						Quản lý tài khoản
					</div>
				</div>
			</li>
			<?php endif ?>
			<?php if ($this->session->userdata('productManager')): ?>
			<li>
				<div id="ProductManager" class="nav-menu__title slidebar-btn">
					<div  class="nav-menu__title-name">
						<div class="icon-menu material-icons">restaurant_menu</div>
						<span>Quản lý sản phẩm</span>
					</div>
				</div>
			</li>
			<?php endif ?>
			<?php if ($this->session->userdata('orderManager')): ?>
			<li>
				<div id="OrderManager" class="nav-menu__title slidebar-btn">
					<div  class="nav-menu__title-name">
						<div class="icon-menu material-icons">list_alt</div>
						<span>Đơn đặt hàng</span>
					</div>
				</div>
			</li>
			<?php endif ?>
			<!-- qr code -->
			<li>
				<div id="QrCode" class="nav-menu__title slidebar-btn">
					<div  class="nav-menu__title-name">
						<div class="icon-menu material-icons">qr_code_2</div>
						<span>QR Code</span>
					</div>
				</div>
			</li>

			<!-- <li>
				<div class="nav-menu__title dropdown-mm">
					<div class="nav-menu__title-name">
						<div class="icon-menu material-icons">menu_book</div>
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
						<div class="icon-menu material-icons">menu_book</div>
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
						<div class="icon-menu material-icons">menu_book</div>
						DashBoard
					</div>
				</div>
			</li>
			<li>
				<div class="nav-menu__title dropdown-mm">
					<div class="nav-menu__title-name">
						<div class="icon-menu material-icons">menu_book</div>
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
						<div class="icon-menu material-icons">menu_book</div>
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
						<div class="icon-menu material-icons">menu_book</div>
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
						<div class="icon-menu material-icons">menu_book</div>
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
			</li> -->
		</ul>
	</div>
</div>
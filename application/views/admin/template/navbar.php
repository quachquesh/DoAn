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
						<div class="user__logo material-icons">
							account_circle
						</div>
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
					<div class="user-level"><?php echo $this->session->userdata('roleName'); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
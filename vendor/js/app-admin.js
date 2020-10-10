document.addEventListener('DOMContentLoaded', function() {

  	// mini menu user
	var btnUser = document.querySelector('.user-pane');
	btnUser.onclick = function() {
		this.classList.toggle('active');
	}

  	// Logout
	document.getElementById('btnLogout').onclick = function() {
		$.ajax({
			url: './api/Logout',
			type: 'POST',
			dataType: 'json'
		})
		.done(function() {
			// window.location = "/admin/Login";
			location.reload();
		})
		.fail(function() {
			console.error("error");
		})
	}

	// Nút ẩn/hiện slide bar
	var btnActiveSlideBar = document.querySelector('.header__pane');
	var slideBarElement = document.querySelector('.app-slidebar');
	var appMain = document.querySelector('.app-main__outer');

	btnActiveSlideBar.onclick = function() {
		if (this.classList.contains('showbar')) {
			this.classList.remove('showbar');
			this.classList.add('hidebar');
			slideBarElement.classList.add('hidebar');
			setTimeout(function() {
				appMain.classList.add('full-width');
			}, 700);
		} else {
			appMain.classList.remove('full-width');
			setTimeout(function() {
				btnActiveSlideBar.classList.remove('hidebar');
				btnActiveSlideBar.classList.add('showbar');
				slideBarElement.classList.remove('hidebar');
			}, 200);
		}
	}

	// Slide bar
	var btnSlideBar = document.querySelectorAll('.nav-menu__title.dropdown-mm');

	btnSlideBar.forEach(function(el) {
		el.onclick = function() {
			var parentElement = this.parentElement;
			var miniMenu = parentElement.querySelector('.mini-menu');
			if (miniMenu.clientHeight) {
				miniMenu.style.height = 0;
			} else {
				miniMenu.style.height = (parentElement.querySelector('.mm-collapse').clientHeight + 3) + "px";
			}
			this.querySelector('.nav-menu__title-icon').classList.toggle('active');

		}
	})

	var slideBarActive = document.querySelectorAll('.nav-menu__title.slidebar-btn');
	var miniMenuItems = document.querySelectorAll('.mm-collapse li');
	slideBarActive.forEach( function(el) {
		el.onclick = function() {
			slideBarActive.forEach( function(element) {
				element.classList.remove('active');
			});
			miniMenuItems.forEach( function(element) {
				element.classList.remove('active');
			});
			this.classList.add('active');
		}
	});
	miniMenuItems.forEach(function(el) {
		el.onclick = function() {
			slideBarActive.forEach( function(element) {
				element.classList.remove('active');
			});
			miniMenuItems.forEach( function(element) {
				element.classList.remove('active');
			});
			this.classList.add('active');
		}
	})

	// click Quản lý tài khoản slide bar menu
	document.getElementById('account-manager').onclick = function() {
		$('#app-main__inner').load('admin/AccountManager');
	}

	// Message Box/ msgbox
	function ShowMsgBox(title, content, button, style = "success") {
		var msgBoxElement = document.getElementById('message-box');
		msgBoxElement.classList.add('show-box');
		msgBoxElement.querySelector('.message-body').classList.add(style);
		msgBoxElement.querySelector('.message-body__title').innerHTML = title;
		msgBoxElement.querySelector('.message-body__content').innerHTML = content;
		msgBoxElement.querySelector('.message-body__button').innerHTML = button;
	}
	var msgBoxElement = document.getElementById('message-box');
	var msgBoxOverLayElement = document.querySelector('.message-box__overlay');
	msgBoxOverLayElement.onclick = function() {
		msgBoxElement.classList.remove('show-box');
	}
	var msgBoxButtonElement = document.querySelector('.message-body__button');
	msgBoxButtonElement.onclick = function() {
		msgBoxElement.classList.remove('show-box');
	}

	window.onload = function() {
		document.querySelector('.loading-page').classList.add('hidden');
	}
},false);
<div class="col c-12 m-12 l-12">
	<div class="inner__body-card row no-gutters card card-block">
		<div class="col c-12 m-10 m-o-1 l-6 l-o-3">
			<div class="card-body">
				<form id="form-create-account">
					<div class="label-group">
						<span>Thông tin tài khoản</span>
					</div>
					<div class="form-group">
						<label>Tên đăng nhập</label>
						<input name="userName" type="text" placeholder="User Name" required>
					</div>
					<div class="form-group">
						<label>Mật khẩu</label>
						<div class="password-box">
							<input name="password" type="password" placeholder="Password" required>
							<div class="eyes-btn">
								<div class="icon-img hide" style="background-image: url(/vendor/img/visibility_off-black-18dp.svg);"></div>
								<div class="icon-img show" style="background-image: url(/vendor/img/visibility-black-18dp.svg);"></div>
							</div>
						</div>
					</div>
					<div class="label-group">
						<span>Thông tin cá nhân</span>
					</div>
					<div class="row no-gutters">
						<div class="col c-12 m-5 l-5">
							<div class="form-group first-name">
								<label for="formGroupExampleInput">Họ và tên lót</label>
								<input name="firstName" type="text" class="form-control" placeholder="Nguyễn Văn" required>
							</div>
						</div>
						<div class="col c-12 m-5 m-o-2 l-5 l-o-2">
							<div class="form-group">
								<label for="formGroupExampleInput">Tên</label>
								<input name="lastName" type="text" class="form-control" placeholder="A" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input name="email" type="email" placeholder="yourname@ssm.com" required>
					</div>
					<div class="form-group">
						<label>Số điện thoại</label>
						<input name="phoneNumber" type="tel" placeholder="03357xxxx" required>
					</div>
					<div class="form-group-select">
						<label>Chức vụ:</label>
						<select name="level">
							<option value="">--- Chọn chức vụ ---</option>
							<?php foreach ($duty as $value): ?>
							<option value="<?php echo $value['level'] ?>"><?php echo $value['duty'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group" style="margin-top: 15px">
						<input type="submit" class="btn btn-submit" value="Tạo tài khoản">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>

	// Show/Hide password
	document.querySelector('.eyes-btn').onclick = function() {
		var parentElement = this.parentElement;
		var eyesHide = parentElement.querySelector('.eyes-btn .icon-img.hide');
		var eyesShow = parentElement.querySelector('.eyes-btn .icon-img.show');
		var inputPwd = parentElement.querySelector('input[name="password"');
		if (inputPwd.getAttribute('type') == 'password') {
			eyesHide.style.display = "block";
			eyesShow.style.display = "none";
			inputPwd.setAttribute('type', 'text');
		} else {
			eyesHide.style.display = "none";
			eyesShow.style.display = "block";
			inputPwd.setAttribute('type', 'password');
		}
	}
	
	// Thêm account
	document.getElementById('form-create-account').onsubmit = function(e) {
		e.preventDefault();
		var form = $(this);
		var formElement = this;
		$.ajax({
			url: '/api/admin/account/CreateAccount',
			type: 'POST',
			dataType: 'json',
			data: form.serialize(),
		})
		.done(function(data) {
			if (data.status == true) {
				ShowMsgBox('Thành công!', 'Thêm tài khoản <b>thành công</b>', 'OK', 'success');
				formElement.querySelectorAll('input[name]').forEach( function(element) {
					element.value = "";
				});
				formElement.querySelector('select[name="level"] option').selected = 'selected';
			}
			else
				ShowMsgBox('Lỗi!', data.message, 'OK', 'fail');
		})
		.fail(function() {
			ShowMsgBox('Thất bại!', 'Tên đăng nhập <b>đã tồn tại</b>', 'OK', 'fail');
		})
		.always(function() {
			// console.log("complete");
		});
		
	}
</script>
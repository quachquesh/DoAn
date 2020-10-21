<style>
	#qrcode-result img {margin: auto;}
</style>

<div class="inner__header">
	<div class="inner__title-icon">
		<div class="icon-img material-icons">qr_code_2</div>
	</div>
	<div class="inner__header-text">
		<div class="inner__header-text-title">
			QR Code
		</div>
		<div class="inner__header-text-content">
			Tạo mã QR Code
		</div>
	</div>
</div>
<div id="inner__body" class="inner__body row" style="margin-top: 20px;">
	<div class="col c-12 m-12 l-6">
		<div class="inner__body-card row no-gutters card card-block">
			<div class="col c-12 m-12 l-12">
				<div class="card-body">
					<form id="form-create-qrcode">
						<div class="label-group">
							<span>Thông tin</span>
						</div>
						<div class="form-group-select">
							<label>Cửa hàng</label>
							<select name="code">
								<option value="">--- Chọn cửa hàng ---</option>
								<?php foreach ($store as $value): ?>
								<option value="<?php echo $value['code'] ?>"><?php echo $value['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<label>Số bàn</label>
							<input name="numberTable" type="text" placeholder="101" required>
						</div>
						<div class="form-group" style="margin-top: 15px">
							<input type="submit" class="btn btn-submit" value="Tạo mã" >
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="col c-12 m-12 l-6">
		<div class="inner__body-card row no-gutters card card-block">
			<div class="col c-12 m-12 l-12">
				<div class="card-body">
					<div class="label-group">
						<span>Mã QR</span>
					</div>
					<div id="qrcode-result"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="/vendor/js/msgBox.js"></script>
<script type="text/javascript" src="/vendor/js/qrcode.min.js"></script>

<script>
	var qrcode = new QRCode(document.getElementById("qrcode-result"), {
		width: 149,
		height: 149,
		colorDark : "#000000",
		colorLight : "#ffffff",
		correctLevel : QRCode.CorrectLevel.M
	});

	var form = document.getElementById('form-create-qrcode');
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		var code = form.querySelector('select[name="code"]').value;
		var numberTable = form.querySelector('input[name="numberTable"]').value;
		qrcode.clear();
		qrcode.makeCode('<?php echo base_url() ?>order?StoreID='+code+'&TableID='+numberTable);
		ShowMsgModal('Thông báo', 'Đã tạo QR Code', 2, 'info');
	})
</script>
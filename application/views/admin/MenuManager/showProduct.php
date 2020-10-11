<div class="col c-12 m-12 l-7">
	<div class="inner__body-card row no-gutters card card-block">
		<div class="col c-12 m-12 l-12">

			<div class="header-card">
				<div class="header-card__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0259e6a3" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
				</div>
				<div class="header-card__title">Thông tin sản phẩm</div>
			</div>

			<div class="card-body">
				<ul class="product-list">
					<?php foreach ($menuData as $key => $value): ?>
						<li class="product-items">
							<div class="product__avt">
								<div class="avt-image" style="background-image: url(<?php echo $value['avt'] ?>);">
									<?php if ($value['itemsNew'] != 0): ?>
									<div class="product-new">New</div>
									<?php endif ?>

									<?php if ($value['bestSeller'] != 0): ?>
									<div class="product-best-seller">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
										Bán chạy
									</div>
									<?php endif ?>
								</div>
							</div>
							<div class="product__name">
								<?php echo $value['name'] ?>
							</div>
							<div class="product__price">
								<?php
									$value['priceCurrent'] = $value['price'];
									if ($value['discount'] != 0) {
										if ($value['discountType'] == 1) {
											$value['priceCurrent'] = $value['priceCurrent']/100*(100-$value['discount']);
										} else if ($value['discountType'] == 2) {
											$value['priceCurrent'] = $value['priceCurrent']-$value['discount'];
										}
									}
									$value['priceCurrent'] = number_format($value['priceCurrent'], 0, ',', '.');
									$value['price'] = number_format($value['price'], 0, ',', '.');

								?>
								<?php if ($value['discount'] != 0): ?>
								<div class="price-old"><?php echo $value['price'] ?> Đ</div>
								<?php endif ?>
								<div class="price-current"><?php echo $value['priceCurrent'] ?> Đ</div>
							</div>
							<div class="button-box">
								<div class="button-edit" data-id="<?php echo $value['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg></div>
								<div class="button-delete" data-id="<?php echo $value['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg></div>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="col c-12 m-12 l-5 mt-c-4 mt-m-4">
	<div class="inner__body-card row no-gutters card card-block">
		<div class="col c-12 m-12 l-12">

			<div class="header-card">
				<div class="header-card__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#e84393" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
				</div>
				<div class="header-card__title">Sửa sản phẩm</div>
			</div>

			<div class="card-body">
				<form id="form-create-product">
					<input type="text" name="productID" hidden>
					<div class="form-group">
						<label>Tên sản phẩm</label>
						<input name="name" type="text" placeholder="Cà phê đen" required>
					</div>
					<div class="form-group-select">
						<label>Loại sản phẩm</label>
						<select name="typeCode">
							<option value="">--- Chọn loại sản phẩm ---</option>
							<?php foreach ($menuType as $value): ?>
							<option value="<?php echo $value['code'] ?>"><?php echo $value['typeName'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Ảnh đại diện</label>
						<input name="avt" id="fileAvt" type="file" required>
					</div>
					<div class="form-group">
						<img class="img-preview" src="/uploads/menu/image_not_supported.svg">
					</div>
					<div class="form-group">
						<label>Giá bán</label>
						<input name="price" type="text" placeholder="10000" required>
					</div>
					<div class="row no-gutters">
						<div class="col c-6 m-6 l-6">
							<div class="form-group-select">
								<label>Sản phẩm mới</label>
								<select name="itemsNew">
									<option value="0">OFF</option>
									<option value="1">ON</option>
								</select>
							</div>
						</div>
						<div class="col c-6 m-6 l-6">
							<div class="form-group-select">
								<label>Bán chạy</label>
								<select name="bestSeller">
									<option value="0">OFF</option>
									<option value="1">ON</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Giảm giá</label>
						<input name="discount" type="text" placeholder="15" required>
					</div>
					<div class="form-group-select">
						<label>Loại giảm giá</label>
						<select name="discountType">
							<?php foreach ($discountType as $key => $value): ?>
								<option value="<?php echo $value['type'] ?>"><?php echo $value['name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>


					<div class="form-group" style="margin-top: 15px">
						<input type="submit" class="btn btn-submit" value="Sửa sản phẩm">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>

	var btnEdit = document.querySelectorAll('.button-edit');
	btnEdit.forEach(function(el) {
		el.addEventListener('click', function() {
			ShowMsgBox('Fail!', 'Chức năng đang được phát triển', 'OK', 'fail');
		})
	})

	var btnDelete = document.querySelectorAll('.button-delete');
	btnDelete.forEach(function(el) {
		el.addEventListener('click', function() {
			ShowMsgBox('Fail!', 'Chức năng đang được phát triển', 'OK', 'fail');
		})
	})

</script>
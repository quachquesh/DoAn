<div class="col c-12 m-12 l-12">
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
					<?php foreach ($menuType as $valueType): ?>
					<div class="label-group" data-typeCode="<?php echo $valueType['code'] ?>">
						<span><?php echo $valueType['typeName'] ?></span>
					</div>
					<?php foreach ($menuData as $value): ?>
					<?php if ($valueType['code'] == $value['typeCode']): ?>
					<li class="product-items" data-group="<?php echo $value['typeCode'] ?>">
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
					<?php endif ?>
					<?php endforeach ?>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="edit-product hidden">
	<div class="inner__body-card row no-gutters card card-block">
		<div class="overlay"></div>
		<div class="form-box col c-12 m-6 l-4 m-o-3 l-o-4">

			<div class="header-card">
				<div class="header-card__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#e84393" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
				</div>
				<div class="header-card__title">Sửa sản phẩm</div>
				<div class="close-tab">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm4 10.59L14.59 16 12 13.41 9.41 16 8 14.59 10.59 12 8 9.41 9.41 8 12 10.59 14.59 8 16 9.41 13.41 12 16 14.59z" opacity=".3"/><path d="M14.59 8L12 10.59 9.41 8 8 9.41 10.59 12 8 14.59 9.41 16 12 13.41 14.59 16 16 14.59 13.41 12 16 9.41zM12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
				</div>
			</div>

			<div class="card-body">
				<form id="form-update-product" method="post">
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
						<input name="avt" id="fileAvt" type="file">
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
						<input type="submit" class="btn btn-submit" value="Cập nhật sản phẩm">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	document.querySelector('.edit-product .overlay').addEventListener('click', function() {
		document.querySelector('.edit-product').classList.add('hidden');
	})
	document.querySelector('.edit-product .close-tab').addEventListener('click', function() {
		document.querySelector('.edit-product').classList.add('hidden');
	})

	var formUpdate = document.getElementById('form-update-product');
	var editData = {element:"", typeCode: "", image: ""};
	formUpdate.addEventListener('submit', function(e) {
		e.preventDefault();
		var form_data = new FormData();
		if ($('#fileAvt').val() != "") {
			form_data.append('file', $('#fileAvt').prop('files')[0]);
		}

		// form_data.append('id', formUpdate.querySelector('input[name="productID"]').value);
		formUpdate.querySelectorAll('input[name]').forEach(function(element) {
			form_data.append(element.getAttribute('name'), element.value);
		})

		formUpdate.querySelectorAll('select').forEach(function(element) {
			var name = element.getAttribute('name');
			form_data.append(name, element.value);
		})
		form_data.append('image-src', editData.image);
		form_data.append('image-update', formUpdate.querySelector('#fileAvt').value);

		$.ajax({
			url: '/api/admin/menu/UpdateProduct',
			type: 'POST',
			dataType: 'json',
			processData: false,
        	contentType: false,
			data: form_data
		})
		.done(function(data) {
			if (data.status == true) {
				ShowMsgBox('Thành công!', data.message, 'OK');
				// Nếu loại sản phẩm không thay đổi
				var dataRes = data.data;
				if (editData.typeCode == dataRes.typeCode) {
					updateProductInfo_Ajax(form_data, dataRes);
				} else { // Nếu loại sản phẩm thay đổi
					// Xóa element hiện tại
					editData.element.remove();

					// Thêm element vào cuối loại đổi sang
					var lastElement = Array.from(document.querySelectorAll('li[data-group="'+dataRes.typeCode+'"]')).pop();
					var content = '<li class="product-items" data-group="'+dataRes.typeCode+'">';
						// Ảnh
						content += '<div class="product__avt">';
						content +=		'<div class="avt-image" style="background-image: url('+dataRes.avt+');">';
						content += 		'</div>';
						content += '</div>';
						// Tên
						content += '<div class="product__name"></div>';
						// Giá
						content += '<div class="product__price"></div>';
						// 2 nút
						content += '<div class="button-box">'
						content += '<div class="button-edit" data-id="72"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path></svg></div>';
						content += '<div class="button-delete" data-id="72"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"></path><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"></path></svg></div>';
						content += '</div>';

						content +='</li>';
					// Nếu không có element cuối
					if (!lastElement) {
						var labelElement = document.querySelector('.label-group[data-typecode="'+dataRes.typeCode+'"]');
						editData.element = $(content).insertAfter(labelElement)[0];
					} else {
						editData.element = $(content).insertAfter(lastElement)[0];
					}
					updateProductInfo_Ajax(form_data, dataRes);
				}
			} else {
				ShowMsgBox('Thất bại!', data.message, 'OK', 'fail');
			}
		})
		.fail(function(data) {
			ShowMsgBox('Fail!', 'Lỗi không xác định', 'OK', 'fail');
		})
		.always(function() {
			document.querySelector('.edit-product').classList.add('hidden');
		});
		
	})

	function updateProductInfo_Ajax(form_data, data) {
		// Nếu thay ảnh khác thì tải lại ảnh
		if (form_data.get('image-update') != "") {
			$.get('/'+data.avt, function() {
				editData.element.querySelector('.avt-image').setAttribute('style', 'background-image: url('+data.avt+')');
			})
		}
		
		// check product new
		var productNew = editData.element.querySelector('.product-new');
		if (productNew) {
			if (data.itemsNew == 0) {
				productNew.remove();
			}
		} else if (data.itemsNew != 0) {
			editData.element.querySelector('.avt-image').innerHTML += '<div class="product-new">New</div>';
		}

		// check product best seller
		var bestSeller = editData.element.querySelector('.product-best-seller');
		if (bestSeller) {
			if (data.bestSeller == 0) {
				bestSeller.remove();
			}
		} else if (data.bestSeller != 0) {
			editData.element.querySelector('.avt-image').innerHTML += '<div class="product-best-seller"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"></path><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"></path></svg>Bán chạy</div>';
		}

		// cập nhật lại tên
		editData.element.querySelector('.product__name').innerText = data.name;

		// Cập nhật giá
		var priceElement = editData.element.querySelector('.product__price');
		priceElement.innerHTML = "";
		// nếu có giảm giá
		var price_old = formatMoney(data.price);
		if (data.discount != 0) {
			// format giá tiền
			priceElement.innerHTML += '<div class="price-old">'+price_old+' Đ</div>';
			if (data.discountType == 2) {
				var price_current = parseInt(data.price) - parseInt(data.discount);
			} else if (data.discountType == 1) {
				var price_current = parseInt(data.price)/100*(100-parseInt(data.discount));
			}
			price_current = formatMoney(price_current+'');
			priceElement.innerHTML += '<div class="price-current">'+price_current+' Đ</div>';
		} else {
			priceElement.innerHTML += '<div class="price-current">'+price_old+' Đ</div>';
		}
	}

	function formatMoney(number) {
		var dem = 1;
		var temp = [];
		var length = number.length;
		var int = parseInt(number);
		for (i = 0; i < length; i++) {
			if (Math.floor(int/1000) > 0) {
				int = Math.floor(int/1000);
				temp.push(number.substring(length-(3*dem), length-(3*(dem-1))));
				dem++;
			} else {
				temp.push(int);
				break;
			}
		}
		var result = "";
		for (i = temp.length-1; i > -1; i--) {
			result += temp[i];
			if (i != 0) {
				result += ".";
			}
		}
		return result;
	}

	// Chọn tệp ảnh mới thì cập nhật hình ảnh preview
	var src = document.getElementById('fileAvt');
	var target = formUpdate.querySelector('.img-preview');
	function showImage(src,target) {
		var fr=new FileReader();
		// when image is loaded, set the src of the image where you want to display it
		fr.onload = function(e) { target.src = this.result; };
		src.addEventListener("change",function() {
			// fill fr with image data    
			fr.readAsDataURL(src.files[0]);
		});
	}
	showImage(src, target);

	var btnEdit = document.querySelectorAll('.button-edit');
	btnEdit.forEach(function(el) {
		el.addEventListener('click', function() {
			var productID = this.getAttribute('data-id');
			editData.element = this.parentElement.parentElement;
			$.ajax({
				url: '/api/admin/MenuManager/getMenuData/'+productID,
				type: 'GET',
				dataType: 'json'
			})
			.done(function(data) {
				formUpdate.querySelector('input[name="productID"]').value = data.id;
				formUpdate.querySelector('input[name="name"]').value = data.name;
				formUpdate.querySelector('.img-preview').setAttribute('src', data.avt);
				editData.image = data.avt;
				formUpdate.querySelector('input[name="price"]').value = data.price;
				formUpdate.querySelector('input[name="discount"]').value = data.discount;
				formUpdate.querySelector('#fileAvt').value = "";

				formUpdate.querySelectorAll('select[name="typeCode"] option').forEach( function(element) {
					if (element.value == data.typeCode) {
						element.selected = true;
						editData.typeCode = data.typeCode;
					} else {
						element.removeAttribute('selected');
					}
				});
				formUpdate.querySelectorAll('select[name="itemsNew"] option').forEach( function(element) {
					if (element.value == data.itemsNew) {
						element.selected = true;
					} else {
						element.removeAttribute('selected');
					}

				});
				formUpdate.querySelectorAll('select[name="bestSeller"] option').forEach( function(element) {
					if (element.value == data.bestSeller) {
						element.selected = true;
					} else {
						element.removeAttribute('selected');
					}

				});
				formUpdate.querySelectorAll('select[name="discountType"] option').forEach( function(element) {
					if (element.value == data.discountType) {
						element.selected = true;
					} else {
						element.removeAttribute('selected');
					}

				});
				document.querySelector('.edit-product').classList.remove('hidden');
			});
		})
	})

	var btnDelete = document.querySelectorAll('.button-delete');
	btnDelete.forEach(function(el) {
		el.addEventListener('click', function() {
			var productID = this.getAttribute('data-id');
			var parentElement = this.parentElement.parentElement;
			$.ajax({
				url: '/api/admin/menu/DeleteProduct',
				type: 'POST',
				dataType: 'json',
				data: {'product-id': productID},
			})
			.done(function(data) {
				if (data.status == true) {
					parentElement.remove();
					ShowMsgBox('Thành công!', data.message, 'OK');
				} else {
					ShowMsgBox('Thất bại!', data.message, 'OK', 'fail');
				}
			})
			.fail(function(data) {
				ShowMsgBox('Error', 'Lỗi không xác định!!', 'OK', 'fail');
			})
			.always(function() {
				// console.log("complete");
			});
			
		})
	})

</script>
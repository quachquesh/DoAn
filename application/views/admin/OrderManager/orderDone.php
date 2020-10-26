<div class="col c-12 m-12 l-12">
	<div class="inner__body-card row no-gutters card card-block">
		<div class="col c-12 m-10 m-o-1 l-8 l-o-2">
			<div class="card-body">
				<table class="list-order" id="order-online">
					<tr>
						<th style="text-align: center">ID</th>
						<th>Sản phẩm</th>
						<th>Ghi chú</th>
						<th style="text-align: center">Bàn</th>
						<th style="text-align: center"></th>
					</tr>
					<?php foreach ($data as $key => $value): ?>
					<tr>
						<td class="order-id"><?php echo $value['id'] ?></td>
						<td class="order-product">
							<?php foreach ($value['productList'] as $valueProc): ?>
								<span>- <?php echo $valueProc->name ?> <b style="color: #ff4757">x <?php echo $valueProc->amount ?></b></span>
							<?php endforeach ?>
						</td>
						<td class="order-note"><?php echo $value['note'] ?></td>
						<td class="order-table"><?php echo $value['tableId'] ?></td>
						<td class="btn-done">
							<span>Duyệt</span>
						</td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	document.querySelectorAll('.list-order .btn-done span').forEach( function(element) {
		element.onclick = function() {
			applyOrder(this);
		}
	});

	function applyOrder(element) {
		var parentElement = element.parentElement.parentElement;
		var id = parentElement.querySelector('.order-id').innerText;
		$.ajax({
			url: '/api/Admin/orderOnline/'+id,
			type: 'DELETE',
			dataType: 'json'
		})
		.done(function(data) {
			if (data.status) {
				parentElement.remove();
				ShowMsgModal('Thành công', data.message);
			} else {
				ShowMsgModal('Thất bại', data.message, 3, 'danger');
			}
		})
		.fail(function() {
			ShowMsgModal('Lỗi', 'Vui lòng kiểm tra kết nối mạng', 3, 'danger');
		})
	}


	<?php $lastID = count($data) != 0 ? end($data)['id'] : 0; ?>
	var lastID = <?php echo $lastID ?>;
	window.orderOnlineRealTime = setInterval(function() {
		if (!document.getElementById('order-online')) {
			window.clearInterval(window.orderOnlineRealTime);
			return false;
		}
		$.ajax({
			url: '/api/Admin/orderOnline',
			type: 'GET',
			dataType: 'json'
		})
		.done(function(data) {
			var result = data.filter(function(value) {
				return value['id'] > lastID;
			});

			result.forEach( function(value) {
				var html = '<tr>';
					html += `<td class="order-id">${value.id}</td>`;
					html += `<td class="order-product">`;
					value.productList.forEach( function(product) {
						html += `<span>- ${product.name} <b style="color: #ff4757">x ${product.amount}</b></span>`
					});
					html += `</td>`;
					html += `<td class="order-note">${value.note}</td>`;
					html += `<td class="order-table">${value.tableId}</td>`;
					html += `<td class="btn-done"><span>Duyệt</span></td>`;
					html += `</tr>`;
				$('#order-online').append(html);

				var element = document.querySelector('#order-online tr:last-child');
				element.querySelector('.btn-done span').onclick = function() {
					applyOrder(this);
				}

				lastID = value.id;
			});
		})
		.fail(function() {
			ShowMsgModal('Lỗi', 'Vui lòng kiểm tra kết nối mạng', 3, 'danger');
		})
	}, 2000)
</script>
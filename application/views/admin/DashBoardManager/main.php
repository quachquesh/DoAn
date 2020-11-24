<div class="inner__header">
	<div class="inner__title-icon">
		<div class="icon-img material-icons">dashboard</div>
	</div>
	<div class="inner__header-text">
		<div class="inner__header-text-title">
			Thống kê
		</div>
		<div class="inner__header-text-content">
			Thống kê các số liệu của hệ thống
		</div>
	</div>
</div>
<div class="inner__body" id="dashboard">
	<div class="create-account inner__body-card row no-gutters">
		<div class="col c-12 m-12 l-10 l-o-1">
			<div class="card card-block">
				<div class="card-body">
					<div>
						<span class="dashboard-title">Thống kê tiền</span>
					</div>

					<div class="date-pick">
						<label for="select-type-date">Kiểu: </label>
						<select name="select-type-date">
							<option value="day">Ngày</option>
							<option value="month">Tháng</option>
							<option value="year">Năm</option>
						</select>
						<label for="date">Thời gian: </label>
    					<input name="date" type="date" class="date-picker" value="<?php echo date("Y-m-d"); ?>"/>
    					<select name="date" style="display: none;"></select>
					</div>

					<canvas id="priceChart" data-chart="chartPrice"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="create-account inner__body-card row no-gutters" style="margin-top: 30px;">
		<div class="col c-12 m-12 l-10 l-o-1">
			<div class="card card-block">
				<div class="card-body">
					<div>
						<span class="dashboard-title">Thống kê đơn hàng</span>
					</div>

					<div class="date-pick">
						<label for="select-type-date">Kiểu: </label>
						<select name="select-type-date">
							<option value="day">Ngày</option>
							<option value="month">Tháng</option>
							<option value="year">Năm</option>
						</select>
						<label for="date">Thời gian: </label>
    					<input name="date" type="date" class="date-picker" value="<?php echo date("Y-m-d"); ?>"/>
    					<select name="date" style="display: none;"></select>
					</div>

					<canvas id="orderChart" data-chart="chartOrder"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/vendor/js/Chart.js"></script>
<script>
	var priceChart = document.getElementById('priceChart').getContext('2d');
	var orderChart = document.getElementById('orderChart').getContext('2d');
	var configPrice = {
	    type: 'line',
	    data: {
	        labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
	        datasets: [{
			        label: 'Tiền khuyến mãi',
			        backgroundColor: '#ff6384',
			        borderColor: 'rgb(255, 99, 132)',
			    },
			    {
			        label: 'Tiền đơn gốc',
			        backgroundColor: '#059BFF',
			        borderColor: '#059BFF',
			    },
			    {
			        label: 'Tiền đơn thanh toán',
			        backgroundColor: '#00ed28',
			        borderColor: '#00ed28',
			    }],
	    },
	    options: {
	    	title: {
	    		fontSize: 16,
				display: true,
				text: 'Thống kê theo ngày'
			},
	    	elements: {
	            line: {
	                tension: 0
	            },
	        },
	        animation: {
	            duration: 750,
	            easing: 'linear',
	        },
	    }
	};
	
	var configOrder = {
	    type: 'line',
	    data: {
	        labels: [],
	        datasets: [{
	            label: 'Đơn hàng hủy bỏ',
	            backgroundColor: '#ff6384',
	            borderColor: 'rgb(255, 99, 132)',
	        },
	        {
	            label: 'Đơn hàng hoàn thành',
	            backgroundColor: '#00ed28',
	            borderColor: '#00ed28',
	        }]
	    },

	    options: {
	    	title: {
	    		fontSize: 16,
				display: true,
				text: 'Thống kê theo ngày'
			},
	    	elements: {
	            line: {
	                tension: 0
	            }
	        },
	        animation: {
	            duration: 750,
	            easing: 'linear',
	        },
	    }
	};
	for (let i = 1; i < 25; i++) {
		configOrder.data.labels[i-1] = i+'h';
		configPrice.data.labels[i-1] = i+'h';
	}

	var dataPrice = [{
        label: 'Tiền khuyến mãi',
        backgroundColor: '#ff638460',
        borderColor: 'rgb(255, 99, 132)',
        data: []
    },
    {
        label: 'Tiền đơn gốc',
        backgroundColor: '#059BFF50',
        borderColor: '#059BFF',
        data: []
    },
    {
        label: 'Tiền đơn thanh toán',
        backgroundColor: '#00ed2850',
        borderColor: '#00ed28',
        data: []
    }];

	var dataOrder = [{
	            label: 'Đơn hàng hủy bỏ',
	            backgroundColor: '#ff638460',
	            borderColor: 'rgb(255, 99, 132)',
	            data: []
	        },
	        {
	            label: 'Đơn hàng hoàn thành',
	            backgroundColor: '#00ed2850',
	            borderColor: '#00ed28',
	            data: []
	        }];

	var resDataPrice = JSON.parse('<?php echo json_encode($dataPrice) ?>');
	for (let i in resDataPrice) {
		dataPrice[0].data[i-1] = resDataPrice[i].discount;
		dataPrice[1].data[i-1] = resDataPrice[i].full;
		dataPrice[2].data[i-1] = resDataPrice[i].price;
	}
	var resDataOrder = JSON.parse('<?php echo json_encode($dataOrder) ?>');
	for (let i in resDataOrder) {
		dataOrder[1].data[i-1] = resDataOrder[i].success;
		dataOrder[0].data[i-1] = resDataOrder[i].fail;
	}

	var chartjs = [];
	chartjs['chartPrice'] = new Chart(priceChart, configPrice);
	chartjs['chartOrder'] = new Chart(orderChart, configOrder);
	
	setTimeout(function() {
		chartjs['chartPrice'].config.data.datasets = dataPrice;
		chartjs['chartPrice'].update();
		chartjs['chartOrder'].config.data.datasets = dataOrder;
		chartjs['chartOrder'].update();
	},100)

	// Xử lý click chọn kiểu thời gian
	document.querySelectorAll('#dashboard .date-pick select[name="select-type-date"]').forEach( function(element, index) {
		element.onchange = function() {

			var loading = document.querySelector('.loading-app-main');
			loading.classList.remove('hidden');

			var parentElement = this.parentElement.parentElement;
			var chartName = parentElement.querySelector('canvas').getAttribute('data-chart');
			var inputDateElement = parentElement.querySelector('input[name="date"]');
			var selectElement = parentElement.querySelector('select[name="date"]');
			
			var startTime = 0;
			var endTime = 0;

			var timeNow = new Date();
			var day = timeNow.getDate();
			var month = timeNow.getMonth();
			var year = timeNow.getFullYear();
			var xData = [];
			xData['xEnd'] = 0;
			xData['xChar'] = '';

			var typeValue = this.value;

			switch (this.value) {
				case 'day':
					selectElement.style.display = 'none';
					inputDateElement.style.display = 'unset';
					inputDateElement.setAttribute('type', 'date');
					inputDateElement.value = getTimeNow();

					startTime = new Date(year, month, day).getTime();
					endTime = new Date(year, month, day+1).getTime();
					xData['xEnd'] = 25;
					xData['xChar'] = 'h';
					break;
				case 'month':
					selectElement.style.display = 'none';
					inputDateElement.style.display = 'unset';
					inputDateElement.setAttribute('type', 'month');
					inputDateElement.value = getTimeNow('month');

					startTime = new Date(year, month, 1).getTime();
					endTime = new Date(year, month+1, 1).getTime();
					xData['xEnd'] = getDaysInMonth(month, year)+1;
					xData['xChar'] = '';
					break;
				case 'year':
					inputDateElement.style.display = 'none';
					selectElement.style.display = 'unset';
					document.querySelector('.date-pick select[name="date"]').innerHTML = "";
					for (var i = getTimeNow('year'); i > 2015; i--) {
						$('.date-pick select[name="date"]').append(`<option value="${i}">${i}</option>`);
					}

					startTime = new Date(year, 0, 1).getTime();
					endTime = new Date(year+1, 0, 1).getTime();
					xData['xEnd'] = 13;
					xData['xChar'] = '';
					break;
			}

			$.ajax({
				url: '/api/Admin/orderHistory',
				type: 'GET',
				dataType: 'json',
				data: {startTime: startTime, endTime: endTime},
			})
			.done(function(data) {
				dataChart = parentElement.querySelector('canvas').getAttribute('data-chart');
				updateChartNow(dataChart, typeValue, xData, data);
			})
			.always(function() {
				loading.classList.add('hidden');
			});
		}
	});

	function updateChartNow(dataChart, typeValue, xData, data) {
		chartjs[dataChart].config.data.labels = [];
		chartjs[dataChart].config.data.datasets[0].data = [];
		chartjs[dataChart].config.data.datasets[1].data = [];
		if (typeof chartjs[dataChart].config.data.datasets[2] != 'undefined') {
				chartjs[dataChart].config.data.datasets[2].data = [];
		}
		
		for (var i = 1; i < xData['xEnd']; i++) {
			chartjs[dataChart].config.data.labels[i-1] = i+xData['xChar'];
			chartjs[dataChart].config.data.datasets[0].data[i-1] = 0;
			chartjs[dataChart].config.data.datasets[1].data[i-1] = 0;
			if (typeof chartjs[dataChart].config.data.datasets[2] != 'undefined') {
				chartjs[dataChart].config.data.datasets[2].data[i-1] = 0;
			}
		}
		if (typeValue == 'day')
			chartjs[dataChart].config.options.title.text = 'Thống kê theo ngày';
		else if (typeValue == 'month')
			chartjs[dataChart].config.options.title.text = 'Thống kê theo tháng';
		else if (typeValue == 'year')
			chartjs[dataChart].config.options.title.text = 'Thống kê theo năm';

		for (let i of data) {
			let strToTime = new Date(new Number(i.id));
			let gio = strToTime.getHours(); // 0-23
			let ngay = strToTime.getDate(); // 1-31
			let thang = strToTime.getMonth(); // 0-11
			if (dataChart == 'chartOrder') {
				switch (typeValue) {
					case 'day':
						if (i.status == '5')
							chartjs['chartOrder'].config.data.datasets[0].data[gio]++;
						else if (i.status == '4')
							chartjs['chartOrder'].config.data.datasets[1].data[gio]++;
						break;
					case 'month':
						if (i.status == '5')
							chartjs['chartOrder'].config.data.datasets[0].data[ngay-1]++;
						else if (i.status == '4')
							chartjs['chartOrder'].config.data.datasets[1].data[ngay-1]++;
						break;
					case 'year':
						if (i.status == '5')
							chartjs['chartOrder'].config.data.datasets[0].data[thang]++;
						else if (i.status == '4')
							chartjs['chartOrder'].config.data.datasets[1].data[thang]++;
						break;
				}
			} else if (dataChart == 'chartPrice') {
				switch (typeValue) {
					case 'day':
						if (i.status == '4') {
							chartjs['chartPrice'].config.data.datasets[0].data[gio] += new Number(i.priceDiscount);
							chartjs['chartPrice'].config.data.datasets[1].data[gio] += new Number(i.priceOrder);
							chartjs['chartPrice'].config.data.datasets[2].data[gio] += new Number(i.pricePayment);
						}
						break;
					case 'month':
						if (i.status == '4') {
							chartjs['chartPrice'].config.data.datasets[0].data[ngay-1] += new Number(i.priceDiscount);
							chartjs['chartPrice'].config.data.datasets[1].data[ngay-1] += new Number(i.priceOrder);
							chartjs['chartPrice'].config.data.datasets[2].data[ngay-1] += new Number(i.pricePayment);
						}
						break;
					case 'year':
						if (i.status == '4') {
							chartjs['chartPrice'].config.data.datasets[0].data[thang] += new Number(i.priceDiscount);
							chartjs['chartPrice'].config.data.datasets[1].data[thang] += new Number(i.priceOrder);
							chartjs['chartPrice'].config.data.datasets[2].data[thang] += new Number(i.pricePayment);
						}
						break;
				}
			} // end switch
		} // end for of
		chartjs[dataChart].update();
	}

	function getTimeNow(type) {
		var now = new Date();
	    var month = (now.getMonth() + 1);               
	    var day = now.getDate();
	    if (month < 10) 
	        month = "0" + month;
	    if (day < 10) 
	        day = "0" + day;
	    switch (type) {
	    	case 'month':
	    		return (now.getFullYear() + '-' + month)
	    	case 'year':
	    		return now.getFullYear()
	    }
	    return (now.getFullYear() + '-' + month + '-' + day);
	}

	// Xử lý click chọn thời gian
	document.querySelectorAll('#dashboard .date-pick [name="date"]').forEach( function(element, index) {
		element.onchange = function() {
			var loading = document.querySelector('.loading-app-main');
			loading.classList.remove('hidden');

			var parentElement = this.parentElement.parentElement;
			var selectType = document.querySelector('#dashboard .date-pick select[name="select-type-date"]');

			var time = new Date(this.value);
		    var day = time.getDate();
			var month = time.getMonth();            
		    var year = time.getFullYear();
		    var xData = [];
			xData['xEnd'] = 0;
			xData['xChar'] = '';

		    var startTime = 0;
		    var endTime = 0;

		    var typeValue = selectType.value;

		    if (typeValue == 'day') {
		    	startTime = new Date(year, month, day).getTime();
				endTime = new Date(year, month, day+1).getTime();
				xData['xEnd'] = 25;
				xData['xChar'] = 'h';
		    } else if (typeValue == 'month') {
		    	startTime = new Date(year, month, 1).getTime();
				endTime = new Date(year, month+1, 1).getTime();
				xData['xEnd'] = getDaysInMonth(month, year)+1;
				xData['xChar'] = '';
		    } else if (typeValue == 'year') {
		    	startTime = new Date(year, 0, 1).getTime();
				endTime = new Date(year+1, 0, 1).getTime();
				xData['xEnd'] = 13;
				xData['xChar'] = '';
		    }

		    $.ajax({
				url: '/api/Admin/orderHistory',
				type: 'GET',
				dataType: 'json',
				data: {startTime: startTime, endTime: endTime},
			})
			.done(function(data) {
				dataChart = parentElement.querySelector('canvas').getAttribute('data-chart');
				updateChartNow(dataChart, typeValue, xData, data);
			})
			.always(function() {
				loading.classList.add('hidden');
			});
		}
	});

	function getDaysInMonth(month,year) {
		return new Date(year, month, 0).getDate();
	};
</script>
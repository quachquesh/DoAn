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
		
		<?php include "navbar.php"; ?>

		<div class="app-main">

			<?php include "slidebar.php"; ?>

			<div class="app-main__outer">
				<div class="outer-box">
					<div class="loading-app-main hidden">
						<svg>
							<circle cx="70" cy="70" r="70"></circle>
						</svg>
					</div>
					<div class="app-main__inner" id="app-main__inner" data-inner="DashBoard">
						<?php include __DIR__ . '/../dashboard_view.php'; ?>
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

	
	<div class="message-modal" id="message-modal"></div>
	<div class="question-box" id="question-box"></div>

	<script  type="text/javascript" src="/vendor/js/jquery-3.5.1.min.js"></script>
	<script  type="text/javascript" src="/vendor/js/app-admin.js"></script>
	<script  type="text/javascript" src="/vendor/js/msgBox.js"></script>
	<script  type="text/javascript" src="/vendor/js/qrcode.min.js"></script>

	<script>
		window.realtime = [];
	</script>
</body>
</html>
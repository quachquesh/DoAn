<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if (isset($title)) {
		echo "<title>$title</title>";
	} else {
		echo "<title>Smart Sales Manager</title>";
	} ?>
	<link rel="icon" href="<?php echo base_url() ?>vendor/img/order-food-32.png">
</head>
<body>
	<?php include 'header.php'?>

	<?php include __DIR__."/../$fileMain" ?>

	<?php include 'footer.php'?>
	<script type="text/javascript" src="<?php echo base_url(); ?>vendor/js/jquery-3.5.1.min.js"></script>
</body>
</html>
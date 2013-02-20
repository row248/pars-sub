<?php require 'script.php' ?>

<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/js.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto:900' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="help">

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input name="deleteCookie" type="submit" value="Начать с начала" onclick="reload()">
		</form>

	</div>

	<div class="main">

		<div class="content" id="content">
			<?php echo $words[$number] ?>
		</div>

		<div class="buttons">

			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input name="previous" type="submit" value="previous" class="float-left" id="left-button">
				<input name="next" type="submit" value="next" class="float-right" id="right-button" onclick=""> 
			</form>

		</div>

	</div>

</body>
</html>
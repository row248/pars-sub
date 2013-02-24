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
			<input name="shuffleArray" type="submit" value="Начать с начала">
		</form>

		<div class="control">
			<span class="showRules">Hide rules</span>
			<ul class="rules">
				<li>Q - next</li>
				<li>A - previous</li>
				<ul>T - highbright</ul>
			</ul>
		</div>

	</div>

	<div class="main">

		<div class="info">
			<span id="number"><?php echo $number; ?> из <?php echo $countWords; ?></span>
			<img class="close-img" src="images/close.png">
		</div>

		<div class="content" id="content">
			<span id="word" class="word"><?php echo htmlspecialchars($words[$number], ENT_QUOTES); ?></span>
			<img class="add-img" src="images/add.jpg">
		</div>

		<div class="buttons">
			<hr>
			<button class="button float-left" onclick="showWordPrevious()">Previous</button>
			<button class="button float-right" onclick="showWordNext()">Next =></button>
		</div>

	</div>

</body>
</html>
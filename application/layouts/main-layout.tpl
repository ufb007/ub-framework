<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<?php if (isset($head['title'])) {?><title><?php echo $head['title']; ?></title><?php } ?>
		<?php if (isset($head['keywords'])) { ?>
			<meta name="keywords" content="<?php echo $head['keywords']; ?>" >
		<?php } ?>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<link href="/css/default.css" media="screen" rel="stylesheet" type="text/css" >
	</head>
	<body>
		<div id="wrapper">
			<div id="body">
				<?php require_once $bodyTpl; ?>
			</div>
			<div id="footer"></div>
		</div>
	</body>
</html>
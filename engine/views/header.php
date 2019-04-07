<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?=Path::relativePath()?>assets/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?=Path::relativePath()?>assets/css/style.css">
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<title><?= $data['title'] ?></title>
</head>

<body>
	<header>
		<div class="container">
			<?php
			if (isset($_SESSION['user'])) echo "Welcome, ".$_SESSION['user'];
			else echo "Not logged in";
			?>
		</div>
	</header>
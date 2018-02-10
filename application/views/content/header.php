<!DOCTYPE html>
<html>
<head>
	<meta charset="utf18">
	<title>Verkkopankki</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Cambay' rel='stylesheet'>
</head>
<body>
	<nav>
		<a href="<?php echo site_url('verkkopankki/home'); ?>">Koti</a>
		<a href="<?php echo site_url('verkkopankki/loginpage'); ?>">Verkkopankki kirjautuminen</a>
		<a href="<?php echo site_url('verkkopankki/adminpage'); ?>">Pankkivirkailija</a>
		<a href="<?php echo site_url('verkkopankki/cardlogin'); ?>">Kortilla kirjautuminen</a>
	</nav>
	<div id="page-content">

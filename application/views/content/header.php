<!DOCTYPE html>
<html>
<head>
	<meta charset="utf18">
	<title>Verkkopankki</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Cambay' rel='stylesheet'>
</head>
<body>
	<div class="main-wrapper">
	<nav class="inside-block">
		<a href="<?php echo site_url('verkkopankki/home'); ?>">Koti</a>
		<a href="<?php echo site_url('verkkopankki/loginpage'); ?>">Verkkopankki kirjautuminen</a>
		<a href="<?php echo site_url('verkkopankki/adminlogin'); ?>">Pankkivirkailija</a>
		<a href="<?php echo site_url('verkkopankki/cardlogin'); ?>">Kortilla kirjautuminen</a>
	</nav>

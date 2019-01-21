<?php require_once 'banque.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"> 
		<title>Banque <?= $nomBanque ?></title>
		<link type="text/css" rel="stylesheet" href="banque.css"/>
	</head>
	<body style="background-color: <?= $couleurBanque ?>;">
	    <header>
			<h1><a href="index.php">Banque <?= $nomBanque ?></a></h1>
			<p>Votre banque en ligne ... en toute confiance.</p>
	    </header>

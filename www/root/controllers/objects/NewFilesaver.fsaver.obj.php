<?php
	
	include "$classesDir"."filesaver.class.php";

	$fsaver = new filesaver;
	$fsaver->username            = $_SESSION['usernameExists'];
	$fsaver->name                = $_FILES['upload']['name'];
	$fsaver->oldNameSwitch       = 'oldNameSwitch';
	$fsaver->newNameSwitch       = 'newNameSwitch';
	$fsaver->selectName          = $_POST['selectName'];
	$fsaver->nameForUpdate       = $_POST['nameForUpdate'];
	$fsaver->type                = $_FILES['upload']['type'];
	$fsaver->size                = $_FILES['upload']['size'];
	$fsaver->tmp_name            = $_FILES['upload']['tmp_name'];
	$fsaver->error               = $_FILES['upload']['error'];
	$fsaver->comments            = $_POST['comments'];
	$fsaver->themesId            = $themesId;	
	$fsaver->resivedHeadersId    = $resivedHeadersId;
	$fsaver->curentUserId        = $curentUserId;
	$fsaver->collector();
	
	 header('Location: . ' ) ;
	 exit();
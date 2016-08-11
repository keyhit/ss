<?php
try
{
  $pdo = new PDO('mysql:host=localhost; dbname=sfs', 'sfsadmin', '12345');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
	
}
catch(PDOException $e)
{
 $error = 'Не можливо підключитися до бази даних.<br> '.
 $e->getMessage();
include $_SERVER['DOCUMENT_ROOT'].'/jokes/errors/error.html.php';
exit();
}

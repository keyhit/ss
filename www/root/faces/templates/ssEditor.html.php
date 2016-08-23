<!DOCTYPE html>
<html>
<head>
	<title>редактор</title>
</head>
<body>




<?php
if (isset($users)) {
	// echo "isset";
	// echo "<br>";
	// echo "користувач - ".$_SESSION['usernameExists'];
	// echo "<br>";
	foreach ($users as $operUsers) {
		
		if ($_SESSION['usernameExists'] == $operUsers['login']) {
			echo 'редагувати'; echo $operUsers['login'];
		}
	}

//echo $user['login'];
}
?>

</body>
</html>
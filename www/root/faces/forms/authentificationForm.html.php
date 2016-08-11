<!DOCTYPE html>
<html>
<head>
	<title>Авторизуйтеся</title>
</head>
<body>
<div>
	
	<div>
		Будь-ласка авторизуйтесь.
	</div>
	
	<form action="." method="POST">
		<div>
			<label for="uExists">Користувач</label>
		</div>
		<div >
			<input type="text" name="usernameExists" id="uExists">
		</div>
			<label for="sExists">Пароль</label>
		</div>
		<div >
			<input type="text" name="passwordExists" id="sExists">
		</div>
		<div>
			<input type="hidden" name="authentification" value="logInUser">
			<input type="submit" value="авторизуватися">
		</div>	
		</form>
		<div>
			<a href="?ifForgetUsernameAndPassword">Нагадати дані авторизації</a>
		</div>
		<div>
		<a href=".">Приховати вікно авторизації</a>
		</div>
</div>

</body>
</html>


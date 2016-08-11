<!DOCTYPE html>
<html>
<head>
	<title>Зареєструйтеся</title>
</head>
<body>
<div>
	<div>
		Будь-ласка введіть реєстраційні дані.
	</div>
	<form action="." method="POST">
		<!--  -->
		<div>
			<label for="uNew">Вигадайте ім'я користувача</label>
		</div>
		<div >
			<input type="text" name="usernameNew" id="uNew" 
			value="<?php echo $_POST['usernameNew'];?>">
		</div>
		<!--  -->
		<div>
			<label for="sNew">Вигадайте пароль</label>
		</div>
		<div >
			<input type="password" name="passwordNew" id="sNew" 
			value="<?php echo $_POST['passwordNew'];?>">
		</div>
		<div>
			<label for="sNewReType">Повторіть пароль</label>
		</div>
		<div >
			<input type="password" name="passwordNewRetype" id="sNewReType" 
			value="<?php echo $_POST['passwordNewRetype'];?>" >
		</div>
		<!--  -->
		<div class='secretQuestion'>
			<select name="secretQuestion">
				<?if(isset($_POST['secretQuestion'])):?>
				<option value="<?php echo $_POST['secretQuestion'];?>"><?php echo $_POST['secretQuestion'];?></option>
				<?php endif;?>
				<option >Виберіть секретне запитання</option>
				<option value="Який Ваший улюблений колір?">Який ваший улюблений колір?</option>
				<option value="Якe Ваше хоббі?">Якe Ваше хоббі?</option>
			</select>
		</div>
		<div class='secretAnsverTheQuestion'>
		<input type="text" name="secretAnswerQuestion" placeholder="Ваша секретна відповідь" value="<?php echo $_POST['secretAnswerQuestion'];?>">
		</div>
		<!--  -->
		<div>
			<label for="realEmailBox">Адреса реальної поштової скриньки</label>
		</div>
		<div>
		  <input type="email" name="realEmail" id="realEmailBox" 
		  value="<?php echo $_POST['realEmail'];?>">
		</div>
		<!--  -->
		<input type="hidden" name="regNewUser" value="registration">
		<!--  -->
		<div>
			<input type="submit" value="Реєстрація">
		</div>	
		</form>

		<div>
		<a href=".">Приховати вікно реєстрації</a>
		</div>
</div>

</body>
</html>
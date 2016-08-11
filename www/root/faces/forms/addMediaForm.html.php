<!DOCTYPE html>
	<html>
	<head>
		<meta charset = "utf-8">
		<title>Завантаження файлу</title>
	</head>
	<body>
		<form action="" method="POST" enctype="multipart/form-data">
	
	<!-- Параметри файлів -->
	<fieldset>
	<legend>Параметри файлів</legend>
		<label for="upload">Вибрати файли з розширенням gif, png, jpeg, jpg, mp4, mp3, wav:<br>
		<input type="hidden" name="MAX_FILE_SIZE" value="200000000">
		
		<input type="file"  id="upload" name="upload" accept="image/gif, image/png, image/jpeg, image/jpg, video/mp4, audio/mp3, audio/wav ">
		</label>
		<br>
		<label>Старе ім'я: <input type="radio" name="selectName" value="oldNameSwitch" checked></label>
		<label>Нове ім'я:  <input type="radio" name="selectName" value="newNameSwitch"></label>
		<input id="newName" type="text" name="nameForUpdate" placeholder="нове ім'я файлу">
	</fieldset>
	<!-- /Параметри файлів -->

	<!-- Вибір теми публікації або створення своєї теми -->
	<fieldset>
	<legend>Теми та заголовки статтей</legend>
			<select name="themesNames" required>
			<option value="" >Виберіть тему</option>
			<?php foreach ($themes as $theme):?>
			<option value="<?php
			echo htmlspecialchars($theme['themesName'], ENT_QUOTES, 'utf-8');?>"><?php 
			echo htmlspecialchars($theme['themesName'], ENT_QUOTES, 'utf-8');?>
			</option>
			<!-- <input type="hidden" name=""> -->
			<?php endforeach;?>
			<option value="ВІДКРИТИ ТЕМУ">ВІДКРИТИ ТЕМУ</option>
			</select>

			<input type="text" name="themeNameNew" placeholder="назва нової теми" >

			<input type="text" name="headesrForThemes" placeholder="місце для заголовоку статті"  required >
	</fieldset>
 	<!-- /Вибір теми публікації або створення своєї теми -->
	
 	<!-- Коментарі до завантажених файлів -->
	<fieldset>
	<legend>Ваш коментар</legend>
		<textarea name="comments" id="comment" rows="5" cols="60"></textarea>
	</fieldset>  
 	<!-- /Коментарі до завантажених файлів --> 
 	
		<input type="hidden" name="action" value="load">
		<input type="submit" value="Завантажити">
	</form>
	<a href=".">Приховати форму</a>
	</body>
	</html>

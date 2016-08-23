
<!DOCTYPE html>
<html>
<head>
	<title>Рейтинг</title>
</head>
<body>
	<form oninput="result.value=parseInt(rating.value)">
		<input ig="rating" type="range"  min="0" max="5" step="1"  value="0" name="rating">	
		<output name="result"> 0</output>
		<input type="submit" value="Оцінити" name="">
	</form>
</body>
</html>
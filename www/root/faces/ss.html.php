<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
	<title><?php $current_dir; ?></title>
	<link rel="stylesheet" type="text/css" href="root/faces/styles/ss/ss.css"/>
  
</head>
<body>

<div class="fieldSite">
<div class="headSite">

<div class="navigation">
<!--  -->
<div class="showAll">
	<a href=".">Все</a>	
</div>
<!--  -->
<div class="showIcons">
	<a href="?icons">Зображення</a>
</div>
<!--  -->
<div class="showAudios">
	<a href="?audios">Музика</a>
</div>
<!--  -->
<div class="showVideos">
	<a href="?videos">Відео</a>
</div>
<!--  -->
<div class="addMedia">
	<a href="?addMedia">Завантажити</a>
</div>
<!--  -->
<div class="info">
<a href="?info">Про нас</a>
</div>

<!--  -->
<?php if($_SESSION['loggedIn'] == FALSE):?>
<!--  -->
<div class="registraion">
	<a href="?registraion">Реєстрація</a>
</div>

<div class="authorization">
	<a href="?authorization">Авторизація</a>
</div>

<? endif;?>
<!--  -->
<?php if($_SESSION['loggedIn'] == TRUE):?>
<div class="unAuthorization">
	<a href="?unAuthorization=loggedOut&goToHome=.">Вийти</a>
</div>
<? endif; ?>


	<?php if ($_SESSION['loggedIn'] == TRUE): ?>
	<!-- Відображення зареєстрованого імені користувача та його статусу -->
<div class="announce">
<!-- Відображення імені користувача -->
	<div class="announceUsername">	
	<?php	echo htmlspecialchars( "Ви - ". $_SESSION['usernameExists'], ENT_QUOTES, 'utf-8');?>
	</div>
	<!-- Відображення статусу користувача -->
	<div class="announceStatus">
<?php 
	if(!isset($users)){
 		echo htmlspecialchars('Відсутній статус', ENT_QUOTES, 'utf-8');
 	}
 	else{
		foreach($users as $user){
			if ($user['login'] == $_SESSION['usernameExists']) {
				echo htmlspecialchars( "статус - ".$user['status'], ENT_QUOTES, 'utf-8');
			}
		}
	}
?>	

</div>
</div>
<?php endif; ?>

<!-- Пошук по темах та заголовках -->
<div class="search">
<form action="." method="POST">
	<input class="searchText" type="text" placeholder=" Пошук публікацій" name="searchText">
	<input type="hidden" name="dataForSearch" value="search">
	<input class="searchSubmit" type="submit" name="" value="OK">
</form>
</div>



</div>

<div class="backGroundForThree">


<div class="themesBlock">

<div class="generalThemesHeaders">

<?php if ($themes[0] <  '0' ): ?>
<?php
	$inform = 'Теми та заголовки відсутні. <br> Створіть їх!';
	include $informMessage;
?>
<?php else: ?>

<?php foreach ($themes as $theme):?>

<a class="nameThemesA" title="<?php 
echo htmlspecialchars($theme['themesName'], ENT_QUOTES, 'utf-8');
?>"
 href="?themesSelector=<?php
echo htmlspecialchars($theme['id'], ENT_QUOTES, 'utf-8'); 
?>"><div class="nameThemes"><?php 
echo htmlspecialchars($theme['themesName'], ENT_QUOTES, 'utf-8');
?></div></a>

<?php if ($headers): ?>
<?php foreach ($headers as $header):?>
<?php if ($theme['id'] and $theme['id'] ==$header['themesId']):?>


<a class="nameHeadersA" title="<?php
echo htmlspecialchars($header['headersNames'], ENT_QUOTES, 'utf-8');?>" 
	href="?headersSelector=<?php
echo htmlspecialchars($header['id'], ENT_QUOTES, 'utf-8');
?>"><div class="nameHeaders"><?php
echo htmlspecialchars($header['headersNames'], ENT_QUOTES, 'utf-8');?>
</div></a>

<?php endif; ?>		
<?php endforeach;?>	
<?php endif; ?>
<?php endforeach;?>	
<?php endif; ?>
</div>
</div>

<div class="middleBlock">
<?php if(isset($medias)):?>
<?php foreach ($medias as $media):?>

<div class="generalBlock">
	<div class="headBlock">
	
	<div class="headersOfPublications">
	<?php
	foreach ($headersM as $headerM) {
		$headerM['id'];
		$headerM['headersNames'];
		if ($media['headersId'] == $headerM['id']) {
			echo htmlspecialchars($headerM['headersNames'], ENT_QUOTES, 'utf-8');
		}
	}
?>
</div>
	<!-- Корисутвач який опублікував статтю -->
	<div class="publishedBy">
		Завантажив
		<?php 
			if (isset($users)) {
				foreach($users as $user){
			if ($user['id'] == $media['userId']) {
				echo htmlspecialchars($user['login'], ENT_QUOTES, 'utf-8');
			}
		}
}
?>	
	</div>
<!--Дата публікації або редагування -->
	<div class="dateBlock">
		<?php echo htmlspecialchars($media['fileUpDate'], ENT_QUOTES, 'utf-8');?>
	</div>

<!--Тема публікації-->

	<div class="themaBlock">
тема:
<?php 
foreach ($themes as $theme) {
 $theme['id'];
 $theme['themesName'];
 if ($media['themesId'] == $theme['id']){
 echo htmlspecialchars($theme['themesName'], ENT_QUOTES, 'utf-8');
}
}
?>
</div>
<!-- Редагування публікації-->
	<div class="operationBlock">
		<a href="?editMediaForm">Редагувати</a>  
	</div>
	
	</div>

	<div class="mediaDataBlock">
		
<?php
		switch ($media['mimeType']) {
		    case 'audio/mp3':?>
		    <audio controls>
		    <source src="<?php
		echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
		echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');?>"
		 type="audio/mp3">
		        </audio>
		        <?php break;
		     case 'audio/wav':?>
		    <audio controls>
		    <source src="<?php
		echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
		echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');?>"
		 type="audio/mp3">
		        </audio>
		        <?php break;

		        
		    case 'image/jpeg':?>
		    <img class="icons" src="<?php
		echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
		echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');?>"width="560" height="320">
		        <?php break;

		        case 'image/jpg':?>
		    <img class="icons" src="
		    <?php
		echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
		echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');?>"width="560" height="320">
		        <?php break;

		        case 'image/gif':?>
		    <img class="icons" src="<?php
		echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
		echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');?>"width="560" height="320">
		        <?php break;

		        case 'image/png':?>
		<img class="icons" src="<?php
		echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
		echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');?>"width="560" height="320">
		        <?php break;


		        case 'video/mp4':?>
						<video controls class="videoPlayer">
						<source src="<?php
						echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
						echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');?>" 
						type="video/mp4">
						</video>
		        <?php break;
		       default:
		        echo "no mimeType";
		        break;
}?>

	</div>
	<div class="commentsBlock">
		<?php echo htmlspecialchars($media['comments'], ENT_QUOTES, 'utf-8');?>
	</div>
</div>
<?php endforeach; ?>
<?php else: ?>
<?php 	$error = 'Дані  згідно Вашого запиту відсутні!!!! ';
	include $errorMessage ;?>
	<?php endif; ?>
</div>

<div class="usersListBlock">

<?php if(!isset($users)):?>
<?echo htmlspecialchars('Користувачі відсутні', ENT_QUOTES, 'utf-8');?>
<? else:?>
<? foreach($users as $user):?>

<!--  -->
<div class="usersButton">
<!--  -->
<div class="userLogoIcon">
<a class="linksForUserLogoIcon" href="?selectByLogin=<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'utf-8');?>">
<img src="<?php
echo htmlspecialchars($user['userLogoIcon'], ENT_QUOTES, 'utf-8');?>">
</a>
</div>
<!--  -->

<div class="login">
<a class="linksForUserLogin" href="?selectByLogin=<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'utf-8');?>">
<?php echo htmlspecialchars($user['login'], ENT_QUOTES, 'utf-8');?>
</a>
</div>
<!--  -->
<div class="status">
<a class="linksForUserStatus" href="?selectByLogin=<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'utf-8');?>">
<?php echo htmlspecialchars($user['status'], ENT_QUOTES, 'utf-8');?>
</a>
</div>
</div>


<?php endforeach;?>
<?php endif;?>
</div>

</div>

<!-- <div class="footer">
    Ra-ta-ta-ta
</div> -->

</div>


</body>
</html> 


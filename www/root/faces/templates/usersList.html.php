<!DOCTYPE html>
<html>
<head>
	<title>Список зареєстрованих користувачів</title>
</head>
<body>
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

</body>
</html>
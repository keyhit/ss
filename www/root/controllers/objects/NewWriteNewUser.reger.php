<?php
// // Файл шляхів. 	
 include $_SERVER['DOCUMENT_ROOT']."/root/links/links.php";

$reger = new WriteNewUser($_POST['usernameNew'],
												$_POST['passwordNew'],
												$_POST['passwordNewRetype'],
												$_POST['secretQuestion'],
												$_POST['secretAnswerQuestion'],
												$_POST['realEmail'],
												$usersDataDir,
												$defIndPhp,
												$informMessage,
												$errorMessage,
												$cautionMessage,
												$sfs);
$reger -> makeDirsForNewUser();

if($reger -> comparisonUsersNames() == FALSE){

		if ($reger -> comparisonTwoPasss() ==TRUE) {
			echo 'Введені паролі однакові.';
			$reger -> insertUserInDb();
			$reger -> makeDirsForNewUser();
			header('Location: .');
			exit();
		}
		else{
	echo 'Перевірте правильнисть введення паролів';
	include 'faces/forms/registrationForm.html.php';			
		}
}

else{
	echo 'Користувач існує!';
	include 'faces/forms/registrationForm.html.php';
	header('Location: .');
	exit();
}
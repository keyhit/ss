<?php
/**
Клас для додавання нових користувачів
**/
class WriteNewUser{
	const USERLOGOICON = 'root/usersData/DefaultUserData/DefaultUserLogo/defIconUsers.bmp';
	const STATUS = 'дописувач';
	public $usernameNew;
	public $passwordNew;
	public $passwordNewRetype;
	public $secretQuestion;
	public $secretAnswerQuestion;
	public $realEmail;


public function __construct($CusernameNew ='', 
														$CpasswordNew ='', 
														$CpasswordNewRetype ='',
														$CsecretQuestion ='',
														$CsecretAnswerQuestion ='',
														$CrealEmail =''){
 	
 	$this->usernameNew					= $CusernameNew; 
	$this->passwordNew 					= $CpasswordNew;
 	$this->passwordNewRetype		=	$CpasswordNewRetype;
	$this->secretQuestion 			= $CsecretQuestion;
	$this->secretAnswerQuestion	=	$CsecretAnswerQuestion;
	$this->realEmail						= $CrealEmail;
}
	
	public function comparisonUsersNames()
	{
		include 'root/controllers/dbConnections/db.inc.php';
  	try
		{
		   $sql = 'SELECT login FROM users WHERE 
					login = :login';
		  $s = $pdo->prepare($sql);
		  $s->bindValue(':login', $this->usernameNew);
		  $s->execute();
		  }
		  catch(PDOException $e)
		  {
		   $error = 'Помилка при пошуку автора';
		   include 'errors/error.html.php';
		   exit();
		 }
		   $row = $s->fetch();
		 print_r($row);

		 if ($row[0] == '')
		 {
		 	echo "Такого користувача в базі немає і він буде доданий!";
		  return FALSE;
		 }
		 else
		 {
		 	echo "В базі вже є такий користувач!";
		  return TRUE;
		 }
	}
	
	public function comparisonTwoPasss(){
		if($this->passwordNew === $this->passwordNewRetype){
			return TRUE;
		}
	}


	public function insertUserInDb(){

	include 'root/controllers/dbConnections/db.inc.php';

			try{
				$sql = 'INSERT INTO users SET
					login        				 = :login,
					pass 				 				 = :pass,
					userLogoIcon 				 = :userLogoIcon,
					status       				 = :status,
					secretQuestion 			 = :secretQuestion,
					secretAnswerQuestion = :secretAnswerQuestion,
					realEmail						 = :realEmail';
					$s = $pdo->prepare($sql);
					$s -> bindValue(':login', $this->usernameNew);
					$s -> bindValue(':pass', $this->passwordNew );
					$s -> bindValue(':userLogoIcon', self::USERLOGOICON);
					$s -> bindValue(':status', self::STATUS);
					$s -> bindValue(':secretQuestion', $this->secretQuestion);
					$s -> bindValue(':secretAnswerQuestion',  $this->secretAnswerQuestion);
					$s -> bindValue(':realEmail', $this->realEmail);
					$s -> execute();
				}
			catch (PDOException $e) {
				$error = 'Помилка додавання в бд.'. $e->getMessage();
				include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
				exit();	
				}
	}

public function makeDirsForNewUser(){
	if ($userDir = mkdir($usersDataDir.$this->usernameNew, 0644, TRUE)){

		$newIndexPhpInUserDir = copy($usersDataDir."index.php", $usersDataDir.$this->usernameNew."/index.php");
		
		echo "<br>Корінний каталог для файлів користувача ".$this->usernameNew." створений!";
	}

	if($userDirIcons = mkdir($_SERVER['DOCUMENT_ROOT'].$usersDataDir.$this->usernameNew."/icons", 0644, TRUE)){

		$newIndexPhpInUserDir = copy($usersDataDir."index.php", "root/usersData/".$this->usernameNew."/icons/index.php");

		echo "<br>Каталог для файлів зображень користувача ".$this->usernameNew." створений!";
	}

	if($userDirVideos = mkdir($_SERVER['DOCUMENT_ROOT'].$usersDataDir.$this->usernameNew."/videos", 0644, TRUE)){

		$newIndexPhpInUserDir = copy($usersDataDir."index.php", $usersDataDir.$this->usernameNew."/videos/index.php");

		echo "<br>Каталог для відео файлів користувача ".$this->usernameNew." створений!";
	}

	if ($userDirAudios = mkdir($_SERVER['DOCUMENT_ROOT'].$usersDataDir.$this->usernameNew."/audios", 0644, TRUE)){

		$newIndexPhpInUserDir = copy($usersDataDir."index.php", $usersDataDir.$this->usernameNew."/audios/index.php");

		echo "<br>Каталог для аудіо файлів користувача ".$this->usernameNew." створений!";
	}
 }
}

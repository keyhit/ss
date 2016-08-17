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
	public $usersDataDir;
	public $defIndPhp;
	public $informMessage;
	public $errorMessage;
	public $cautionMessage;
	public $sfs;

public function __construct($CusernameNew ='', 
														$CpasswordNew ='', 
														$CpasswordNewRetype ='',
														$CsecretQuestion ='',
														$CsecretAnswerQuestion ='',
														$CrealEmail ='',
														$CusersDataDir ='',
														$CdefIndexPhp ='',
														$CinformMessage ='',
														$CerrorMessage = '',
														$CcautionMessage ='',
														$Csfs =''){
 	
 	$this->usernameNew					= $CusernameNew; 
	$this->passwordNew 					= $CpasswordNew;
 	$this->passwordNewRetype		=	$CpasswordNewRetype;
	$this->secretQuestion 			= $CsecretQuestion;
	$this->secretAnswerQuestion	=	$CsecretAnswerQuestion;
	$this->realEmail						= $CrealEmail;
	$this->usersDataDir				  = $CusersDataDir;
	$this->defIndPhp						= $CdefIndexPhp;
	$this->informMessage        = $CinformMessage;
	$this->errorMessage         = $CerrorMessage;
	$this->cautionMessage       = $CcautionMessage;
	$this->sfs                  = $Csfs;
}
	
	public function comparisonUsersNames()
	{
		
		include $this->sfs;
  	try
		{
		   $sqlComp = 'SELECT login FROM users WHERE 
					login = :login';
		  $sComp = $pdo->prepare($sqlComp);
		  $sComp->bindValue(':login', $this->usernameNew);
		  $sComp->execute();
		  }
		  catch(PDOException $e)
		  {
		   $error = 'Помилка при пошуку автора'. $e->getMessage();
		   $this->errorMessage;
		   exit();
		 }
		   $row = $sComp->fetch();
		 //print_r($row);

		 if ($row[0] == '')
		 {
		 	$inform = "Такого користувача в базі немає і він буде доданий!";
		 	$this->informMessage;
		  return FALSE;
		 }
		 else
		 {
		 	$inform = "В базі вже є такий користувач!";
		 	$this->informMessage;
		  return TRUE;
		 }
	}
	
	public function comparisonTwoPasss(){
		if($this->passwordNew === $this->passwordNewRetype){
			return TRUE;
		}
	}


	public function insertUserInDb(){

 	include $this->sfs;

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
				$this->errorMessage;;
				exit();	
				}
	}

public function makeDirsForNewUser(){

	// Створення каталогів користувачів на сервері.	 
 	if($userDir = mkdir($this->usersDataDir.$this->usernameNew, 0644, TRUE) and	
 		$newIndexPhpInUserDir = copy($this->defIndPhp, $this->usersDataDir.$this->usernameNew."/index.php")){
	 	$inform = "<br>Корінний каталог для файлів користувача ".$this->usernameNew." створений!";
	  include $this->informMessage;
	}

 	if($userDirIcons = mkdir($this->usersDataDir.$this->usernameNew."/icons", 0644, TRUE) and
 		$newIndexPhpInUserDir = copy($this->defIndPhp, $this->usersDataDir.$this->usernameNew."/icons/index.php")){
		$inform = "<br>Каталог для файлів зображень користувача ".$this->usernameNew." створений!";
		include $this->informMessage;
	}

 	if($userDirIcons = mkdir($this->usersDataDir.$this->usernameNew."/videos", 0644, TRUE) and
 		$newIndexPhpInUserDir = copy($this->defIndPhp, $this->usersDataDir.$this->usernameNew."/videos/index.php")){
		$inform = "<br>Каталог для файлів відео користувача ".$this->usernameNew." створений!";
		include $this->informMessage;	
	}
 	
 	if($userDirIcons = mkdir($this->usersDataDir.$this->usernameNew."/audios", 0644, TRUE) and
 		$newIndexPhpInUserDir = copy($this->defIndPhp, $this->usersDataDir.$this->usernameNew."/audios/index.php")){
		$inform = "<br>Каталог для файлів аудіо користувача ".$this->usernameNew." створений!";
		include $this->informMessage;
	}

 	if($userDirIcons = mkdir($this->usersDataDir.$this->usernameNew."/person", 0644, TRUE) and
 		$newIndexPhpInUserDir = copy($this->defIndPhp, $this->usersDataDir.$this->usernameNew."/person/index.php")){
		$inform = "<br>Каталог для файлів персоналізації користувача ".$this->usernameNew." створений!";
		include $this->informMessage;
	}
 }
}









<?php

class filesaver{
	const USERSDATADIR = "root/UsersData/";
	const CURDATETIME ="date('YMd_H-i-s')";
	const DATEFORDB = "date('d:m:y H:i')";
	public $username;
	public $name;
	public $selectName;
	public $oldNameSwitch;
	public $newNameSwitch;
	public $nameForUpdate;
	public $type; 
	public $size; 
	public $tmp_name;
	public $error;
	public $comments;
	public $themesId;
	public $resivedHeadersId;
	public $curentUserId;
	

	public function collector(){
		
		include $_SERVER['DOCUMENT_ROOT'].'/root/links/links.php';

		$pathToDir =  self::USERSDATADIR.$this->username."/"."$targetDir";
		$fileNaming = self::CURDATETIME."_".$_SERVER['REMOTE_ADDR']."$extension";

		//icons розширення файлів зображень
		if (preg_match('/^(image)+\/+(jpe?g)+$/i', $this->type )){
		$extension = ".jpeg";
		$targetDir = 'icons/';
		}

		if (preg_match('/^(image)+\/+(gif)+$/i', $this->type )){
		$extension = ".gif";
		$targetDir = 'icons/';
		}

		if (preg_match('/^(image)+\/+(png)+$/i', $this->type )){
		$extension = ".png";
		$targetDir = 'icons/';
		}

		//videos розширення файлів відео (тільки mp4)
		if (preg_match('/^(video)+\/+(mp4|MP4)+$/i', $this->type )){
		$extension = ".mp4";
		$targetDir = 'videos/';
		}

		//audios розширення файлів аудіо
		if (preg_match('/^(audio)+\/+(mp3)+$/i', $this->type )){
		$extension = ".mp3";
		$targetDir = 'audios/';
		}
		// if (preg_match('/^(audio)+\/+(wav|x-wav)+$/i', $this->type )){
		// $extension = ".wav";
		// $targetDir = 'audios/';
		// }
	
		switch ($extension) {
			case preg_match('/^(audio)+\/+(wav|x-wav)+$/i', $this->type ):
				$extension = ".wav";
				$targetDir = 'audios/';
				break;
			
			default:
				# code...
				break;
		}




		if (isset($this->selectName) and $this->selectName == $this->newNameSwitch){

			$fileNamingForDb = $this->nameForUpdate."$extension";
		}
		elseif(isset($this->selectName) and $this->selectName == $this->oldNameSwitch){
			$fileNamingForDb = $this->name;
		}

		//шлях для зберігання файлів записаний у вигляді змінних		
		$pathToFile = "$pathToDir$fileNaming";

// перевірка розширень файлів jpeg, gif, png, mp4, mp3, wav
		if (preg_match('/^[a-zA-Z]+\/+(jpe?g|gif|png|mpeg|mp4|mp3|mpeg3|x-mpeg-3|mpeg|x-mpeg|wav|x-wav|wave)+$/i', $this->type)){

// Записуємо файл у каталог на сервері під унікальним іменем
		$savingFile = move_uploaded_file($this->tmp_name, $pathToFile);

		if (isset($savingFile)){
		echo 'Файл збережено успішно!<br>';


// вносим дані про забережений файл до таблиці бази даних
		include "$sfs";
		try{
				$sql = 'INSERT INTO links SET
					pathToDir        = :pathToDir,
					fileNaming       = :fileNaming,
					fileNamingForDb  = :fileNamingForDb,
					mimeType         = :mimeType,
					comments         = :comments,
					fileUPDate       = :fileUPDate,
					userId           = :userId,
					headersId        = :headersId,
					themesId         = :themesId';
					$s = $pdo->prepare($sql);
					$s -> bindValue(':pathToDir',       $pathToDir);
					$s -> bindValue(':fileNaming',      $fileNaming);
					$s -> bindValue(':fileNamingForDb', $fileNamingForDb);
					$s -> bindValue(':mimeType',        $this->type);
					$s -> bindValue(':comments',        $this->comments);
					$s -> bindValue(':fileUPDate',      self::DATEFORDB);
					$s -> bindValue(':userId',          $this->curentUserId);
					$s -> bindValue(':headersId',       $this->resivedHeadersId);
					$s -> bindValue(':themesId',        $this->themesId);
					$s -> execute();
				}
			catch (PDOException $e) {
				$error = 'Помилка додавання в бд.'. $e->getMessage();
				include "$errorMessage";
				exit();	
				}
		}
		else{ 
		$error = 'Помилка при зберіганні файлу';
		include "$errorMessage";
		exit();
		}
		}

		else{
			$error = 'Завантажте файл jpeg, gif, png, mp4, mp3, wav формату! ';
			include "$errorMessage";
			exit();

		}
	}

}
<?php 
// Файл з шляхами 
include $_SERVER['DOCUMENT_ROOT'].'/root/links/links.php';
// Файл з шляхами

// Функції для авторизації та визначення прав користувача
include "$functions"."authentificationAndRules.func.php";
// Функції для авторизації та визначення прав користувача

//Вибираємо всі  теми з бази даних
include '/root/controllers/dbConnections/db.inc.php';
try {
			$sqlThemes = 'SELECT id, themesName, headersId FROM themes';
			$resulThemes = $pdo->query($sqlThemes);
		} 
catch (PDOException $e) {
	$error = 'Помилка виборки з бд.'. $e->getMessage();
	include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
	exit();	
}

foreach ($resulThemes as $row) {
	$themes[] = array(
		'id'         => $row['id'],
		'themesName' => $row['themesName'],
		'headersId'  => $row['headersId']);
}
// /Вибираємо всі  теми з бази даних

//////////////////////////////


//Вибираємо всі заголовки  з бази даних у відповідності до запитів головного меню
if (isset($_GET['themesSelector']) and $_GET['themesSelector'] !==''){
$select = "SELECT id,  headersNames, linksHeadersId, themesId ";
$from   = "FROM headers ";
$where  = "WHERE themesId = ".$_GET['themesSelector'];
}

if (!isset($_GET['themesSelector'])){
$select = "SELECT id, headersNames, linksHeadersId, themesId ";
$from   = "FROM headers ";
$where  = "WHERE themesId = 0";
}

try {
			$sqlHeaders =  $select.$from.$where;
			$resulHeaders = $pdo->query($sqlHeaders);
		} 
catch (PDOException $e) {
	$error = 'Помилка виборки з бд.'. $e->getMessage();
	include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
	exit();	
}

foreach ($resulHeaders as $row) {
	$headers[] = array(
		'id'         => $row['id'],
		'headersNames' => $row['headersNames'],
		'linksHeadersId'  => $row['linksHeadersId'],
		'themesId'  => $row['themesId'],
		);
}
// /Вибираємо всі заголовки  з бази даних у відповідності до запитів головного меню
// вибір заголовків для блоку медіа
try {
			$sqlHeadersM =  'SELECT id, headersNames, linksHeadersId, themesId FROM headers';
			$resulHeadersM = $pdo->query($sqlHeadersM);
		} 
catch (PDOException $e) {
	$error = 'Помилка виборки з бд.'. $e->getMessage();
	include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
	exit();	
}

foreach ($resulHeadersM as $row) {
	$headersM[] = array(
		'id'         => $row['id'],
		'headersNames' => $row['headersNames'],
		'linksHeadersId'  => $row['linksHeadersId'],
		'themesId'  => $row['themesId'],
		);
}
// /вибір заголовків для блоку медіа

//////////////////////////////

// Вибірка медіа даних з бази
$MediaSelect = "SELECT id, pathToDir, fileNaming, 
	fileNamingForDb, mimeType, comments, fileUpDate, userId,
		headersId, visible, themesId FROM links";

if (isset($_GET['themesSelector']) ) {
$whereMedia = " WHERE themesId = ".$_GET['themesSelector'];	
}

if (isset($_GET['headersSelector']) ) {
$whereMedia = " WHERE headersId = ".$_GET['headersSelector'];	
}

if (isset($_GET['icons']) ) {
$whereMedia = " WHERE mimeType LIKE '%image%'";	
}

if (isset($_GET['audios']) ) {
$whereMedia = " WHERE mimeType LIKE '%audio%'";	
}
if (isset($_GET['videos']) ) {
$whereMedia = " WHERE mimeType LIKE '%video%'";	
}
if (isset($_POST['dataForSearch']) and $_POST['dataForSearch'] == 'search') {
	$searchMediaText = "'%".$_POST['searchText']."%'";
	$whereMedia = " WHERE comments LIKE".$searchMediaText;
}

if (isset($_GET['selectByLogin'])) {
	$whereMedia =  " WHERE userId = ".$_GET['selectByLogin'] ;
}


try {
	$sqlMediaSel = $MediaSelect.$whereMedia;
	$result = $pdo->query($sqlMediaSel);

} 
catch (PDOException $e) {
	$error = 'Помилка виборки з бд.'. $e->getMessage();
	include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
	exit();	
}

foreach($result as $row){
	$medias[] = array(
	'id'              => $row['id'],
	'pathToDir'       => $row['pathToDir'],
	'fileNaming'      => $row['fileNaming'],
	'fileNamingForDb' => $row['fileNamingForDb'],
	'mimeType'        => $row['mimeType'],
	'comments'        => $row['comments'],
	'fileUpDate'      => $row['fileUpDate'],
	'userId'          => $row['userId'],
	'headersId'       => $row['headersId'],
	'visible'         => $row['visible'],
	'themesId'        => $row['themesId']); 	
}
// / Вибірка медіа даних з бази

//////////////////////////////

//вибираємо всіх корисутвачів з бази
$SelectUsers = "SELECT id, login, userLogoIcon, status FROM users ";

if (isset($_POST['dataForSearch']) and $_POST['dataForSearch'] == 'search') {
	$searchUsersText = "'%".$_POST['searchText']."%'";
	$whereUsers = " WHERE login LIKE".$searchUsersText;
}



try {
			$sqlUsers = $SelectUsers.$whereUsers;
			$resultUsers = $pdo->query($sqlUsers);
		} 
catch (PDOException $e) {
	$error = 'Помилка виборки з бд.'. $e->getMessage();
	include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
	exit();	
}

foreach ($resultUsers as $row) {
	$users[] = array(
		'id' 					 => $row['id'],
		'login'        => $row['login'],
		'userLogoIcon' => $row['userLogoIcon'],
		'status'       => $row['status']);
}

// Вибираємо ідентифікатор користувача який зараз авторизований
// потрібно це для додавання даних в таблицю links
if (isset($_SESSION['usernameExists'])) {
		if (isset($users)) {
			
		
		foreach ($users as $key) {
		if($_SESSION['usernameExists'] == $key['login']){
				//ідентифікатор авторизованого користувача
				$curentUserId =  $key['id'];
			}
	}
}	
//echo 'Існує імя користувача - '.$_SESSION['usernameExists'].' з id = '.$curentUserId;
}

// /вибираємо всіх корисутвачів з бази

//////////////////////////////

// Завантаження медіа
if (isset($_POST['action']) and  $_POST['action'] == 'load' ){

// Записуємо нові теми в таблицю тем
if (isset($_POST['themesNames']) and $_POST['themesNames'] == 'ВІДКРИТИ ТЕМУ'){
include "$sfs";
				try{
			$sqlInsertThemesName = 'INSERT INTO themes SET
				themesName          = :themesName';
				$itn = $pdo->prepare($sqlInsertThemesName);
				$itn -> bindValue(':themesName',  $_POST['themeNameNew']);
				$itn -> execute();
			}
			catch (PDOException $e) {
				$error = 'Помилка запису в бд.'. $e->getMessage();
				include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
				exit();	
			}

		// отримуємо останній доданий ідентифікатор до таблиці тем
		$resivedThemesId = $pdo->lastInsertId();
		// /отримуємо останній доданий ідентифікатор до таблиці тем

}		
// /Записуємо нові теми в таблицю тем




// Вибір ідентифікатора існуючої теми
if (isset($_POST['headesrForThemes']) and $_POST['headesrForThemes'] !==  'ВІДКРИТИ ТЕМУ' and $_POST['headesrForThemes'] !==  '') {
include "$sfs";

try {
			$sqlThemesIds = 'SELECT id FROM themes WHERE
			themesName = :themesNames';
			$resultTIs = $pdo->prepare($sqlThemesIds);
			$resultTIs ->bindValue(':themesNames', $_POST['themesNames']);
			$resultTIs ->execute();
		} 
		catch (PDOException $e) {
			$error = 'Помилка виборки з бд.'. $e->getMessage();
			include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
			exit();	
		}

		foreach ($resultTIs as $row) {
			$themesIds[] = array(
			'id'        => $row['id']);
		}
}
// /Вибір ідентифікатора існуючої теми

// Визначаємо ідентифікатор тем
if (isset($resivedThemesId)) {
	$themesId = $resivedThemesId; 
}
else{
	$themesId = $row['id'];
}
// /Визначаємо ідентифікатор тем

// Записуємо нові заголовки в таблицю заголовків
					try{
					$sqlInsertHeadersAIndexes = 'INSERT INTO headers SET
					headersNames          = :headersNames,
					themesId              = :themesId';
					$ihi = $pdo->prepare($sqlInsertHeadersAIndexes);
					$ihi -> bindValue(':headersNames',  $_POST['headesrForThemes']);
					$ihi -> bindValue(':themesId', $themesId);
					$ihi -> execute();
					}
					catch (PDOException $e) {
					$error = 'Помилка запису в бд.'. $e->getMessage();
					include $_SERVER['DOCUMENT_ROOT']. '/sfs/error.html.php';
					exit();	
					}
					$resivedHeadersId = $pdo->lastInsertId();
// /Записуємо нові заголовки в таблицю заголовків

//////////////////////////////
//////////////////////////////////////////////////////opopopopop/
include "$objectsDir"."NewFilesaver.fsaver.obj.php";	



}

/////////////////////////////

// Видалення файлів
// Видалення файлів з каталогів
if (isset($_POST['deleteFile']) and $_POST['deleteFile'] == 'Видалити' ) {
	
	if (!unlink($_POST['pathToUnlinkingFile'])) {
			
			echo "Видалення не можливе";
		}
  	else{
			echo "Видалено";
	  }
// /Видалення файлів з каталогів

// Видалення записів про файли з бази даних
include 'db.inc.php';
try
{
	$sql = 'DELETE FROM links WHERE id = :id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $_POST['idFileByDb']);
	$s->execute();
}
catch (PDOException $e)
{
	$error = 'Ошибка при удалении шутки: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}
	 header('Location: . ' ) ;
	 exit();
}









// Видалення файлів
// Видалення файлів з каталогів
if (isset($_GET['remove']) and $_GET['remove'] =='removePublication' ) {

	if (!unlink($_GET['path'])) {
			
			echo "Видалення не можливе";
		}
  	else{
			echo "Видалено";
		}
// /Видалення файлів з каталогів

// Видалення записів про файли з бази даних
include "$sfs";
try
{
	$sql = 'DELETE FROM links WHERE id = :id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $_GET['id']);
	$s->execute();
}
catch (PDOException $e)
{
	$error = 'Ошибка при удалении шутки: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}
	 header('Location: . ' ) ;
	 exit();
}
// /Видалення записів про файли з бази даних



//////////////////////////////

// Виконуємо реєстрацію нового користувача
if (isset($_POST['regNewUser']) and $_POST['regNewUser'] == 'registration'
	and $_POST['usernameNew'] !==''
	and $_POST['passwordNew']!==''
	and $_POST['passwordNewRetype'] !==''
	and $_POST['passwordNewRetype'] !==''
	and $_POST['secretQuestion'] !==''
	and $_POST['secretAnswerQuestion'] !==''
	and $_POST['realEmail'] !=='') {
	include $classesDir."WriteNewUser.class.php";
	include $objectsDir."NewWriteNewUser.reger.php";
}
// else{
// 	$error = "Потрібно ввести дані для реєстрації";
// 	include "$errorMessage";
// }
// /Виконуємо реєстрацію нового користувача

// показуємо форму завантаження медіа
 if(isset($_GET['addMedia'])){
 
	if ($_SESSION['loggedIn'] == TRUE) {
	include 'root/faces/forms/addMediaForm.html.php';
	}
	else{

		$error = 'Зареєструйтесь будь-ласка!';
		include 'root/faces/cei/error.html.php';
	}
}
// /показуємо форму завантаження медіа

// показуэмо форму редагування медіа
 if(isset($_GET['editMediaForm'])){
 include 'faces/forms/editMediaForm.html.php';
}
// /показуэмо форму редагування медіа

// Показуємо форму авторизації
 if(isset($_GET['authorization'])){
 include "$forms"."authentificationForm.html.php";
}
// /Показуємо форму авторизації 

// Показуємо форму реєстрації
 if(isset($_GET['registraion'])){
 include 'root/faces/forms/registrationForm.html.php';
} 
// /Показуємо форму реєстрації

// Показуємо форму відновлення паролю
if (isset($_GET['ifForgetUsernameAndPassword'])) {
include 'faces/forms/ifForgetUsernameAndPassword.html.php';
}
// /Показуємо форму відновлення паролю

// показуэмо головну сторінку
include '/root/faces/ss.html.php';
// /показуэмо головну сторінку





<?php




function userIsLoggedIn()
{
  if (isset($_POST['authentification']) and $_POST['authentification'] == 'logInUser')
  {
    if (!isset($_POST['usernameExists']) or $_POST['usernameExists'] == '' or
      !isset($_POST['passwordExists']) or $_POST['passwordExists'] == '')
    {
      $GLOBALS['loginError'] = 'Будь-ласка, заповніть обидва поля';
      return FALSE;
    }

    //$passwordExists = md5($_POST['passwordExists'] . 'ijdb');

			$passwordExists = $_POST['passwordExists'];

    if(databaseContainsAuthor($_POST['usernameExists'], $passwordExists))
    {
      session_start();
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['usernameExists'] = $_POST['usernameExists'];
      $_SESSION['passwordExists'] = $passwordExists;
      return TRUE; 
    }
    else
    {
     session_start();
     unset($_SESSION['loggedIn'] );
     unset($_SESSION['usernameExists']);
     unset($_SESSION['passwordExists']);
     $GLOBALS['loginError'] =
      'Вказана неправильна адреса електронної пошти або пароль.';
    return FALSE;
    }
}    
  if(isset($_GET['unAuthorization']) and $_GET['unAuthorization'] == 'loggedOut' )
  {
    session_start();
    unset($_SESSION['loggedIn'] );
    unset($_SESSION['usernameExists']);
    unset($_SESSION['passwordExists']);
    header('location:'.$_GET['goToHome']);
    exit();
  }
  
  session_start();
  if(isset($_SESSION['loggedIn']))
  {
    return databaseContainsAuthor($_SESSION['usernameExists'],  $_SESSION['passwordExists']);
  }
}        
 userIsLoggedIn();

function databaseContainsAuthor($usernameExists, $passwordExists)
  {
    // Файл з шляхами 
include $_SERVER['DOCUMENT_ROOT'].'/root/links/links.php';
// Файл з шляхами  
   include "$sfs";
    
  try
  {
     $sql = 'SELECT id, login, pass FROM users WHERE 
				login = :login
				AND 
 	 			pass = :pass';
    $s = $pdo->prepare($sql);
    $s->bindValue(':login', $usernameExists);
    $s->bindValue(':pass', $passwordExists);
    $s->execute();
    }
    catch(PDOException $e)
    {
     $error = 'Помилка при пошуку автора';
     include 'errors/error.html.php';
     exit();
   }
     $row = $s->fetch();
   if ($row[0] > '0')
   {
   	// echo " more then null ";
    return TRUE;
   }
   else
   {
   	// echo ' less then hull ';
    return FALSE;
   }
  

}   
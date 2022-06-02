<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','localhost');
define('DBUSER','database username');
define('DBPASS','password');
define('DBNAME','database name');

//application address
define('DIR','http://domain.com/');
define('SITEEMAIL','noreply@domain.com');

//include the user class, pass in the database connection
include_once('includes/pdo.php');
include_once('classes/user.php');
include_once('classes/phpmailer/mail.php');
include_once('classes/controller.php');

// create PDO connection
$db = new DBPDO(DBNAME, DBUSER, DBPASS, DBHOST);
// create User
$user = new User($db);
// create controller
$controller = new Controller($db, $user);
?>
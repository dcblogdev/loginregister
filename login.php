<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }

//process login form if submitted
if(isset($_POST['submit'])){

	if (! isset($_POST['username'])) {
		$error[] = "Please fill out all fields";
	}

	if (! isset($_POST['password'])) {
		$error[] = "Please fill out all fields";
	}

	$username = $_POST['username'];
	if ($user->isValidUsername($username)){
		if (! isset($_POST['password'])){
			$error[] = 'A password must be entered';
		}

		$password = $_POST['password'];

		if ($user->login($username, $password)){
			$_SESSION['username'] = $username;
			header('Location: memberpage.php');
			exit;

		} else {
			$error[] = 'Wrong username or password or your account has not been activated.';
		}
	}else{
		$error[] = 'Usernames are required to be Alphanumeric, and between 3-16 characters long';
	}

}//end if submit

//define page title
$title = 'Login';

//include header template
require('layout/header.php'); 
?>

<section class="container">
	<section class="row">
	    <section class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<?php require_once('./layout/views/vLogin.php'); ?>
		</section>
	</section>
</section>

<?php 
//include header template
require('layout/footer.php'); 
?>

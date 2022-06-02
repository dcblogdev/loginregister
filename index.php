<?php 
require('includes/config.php');

//if logged in redirect to members page
if ($user->is_logged_in()){ header('Location: memberpage.php'); exit(); }

//if form has been submitted process it
if(isset($_POST['submit'])){

    if (! isset($_POST['username'])) $error[] = "Please fill out all fields";
    if (! isset($_POST['email'])) $error[] = "Please fill out all fields";
    if (! isset($_POST['password'])) $error[] = "Please fill out all fields";

	$username = $_POST['username'];
	$row = $controller->getUserByName($username);
	if($row){
		if (! empty($row['username'])) $error[] = 'Username provided is already in use.';
	}
	else $error[] = 'Usernames must be at least 3 Alphanumeric characters';

	if (strlen($_POST['password']) < 3) $error[] = 'Password is too short.';
	if (strlen($_POST['passwordConfirm']) < 3) $error[] = 'Confirm password is too short.';
	if ($_POST['password'] != $_POST['passwordConfirm']) $error[] = 'Passwords do not match.';

	//email validation
	$email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
	$row = $controller->getUserByEmail($email);
	if($row){
		if (! empty($row['email'])) $error[] = 'Email provided is already in use.';
	}
	else $error[] = 'Please enter a valid email address';

	//if no errors have been created carry on
	if (!isset($error)){
		$controller->insertUser($username, $_POST['password'], $email);
		//redirect to index page
		header('Location: index.php?action=joined');
		exit;
	}
}

//define page title
$title = 'Demo';

//include header template
require('layout/header.php');
?>

<section class="container">
	<section class="row">
	    <section class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<?php require_once('layout/views/vRegistration.php'); ?>
		</section>
	</section>
</section>

<?php
//include header template
require('layout/footer.php');
?>
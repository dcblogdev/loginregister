<?php require('includes/config.php'); 

//if logged in redirect to members page
if ($user->is_logged_in() ){ header('Location: memberpage.php'); exit(); }

$resetToken = $_GET['key'];
$row = $controller->getResetToken($resetToken);

//if no token from db then kill the page
if (empty($row['resetToken'])){
	$stop = 'Invalid token provided, please use the link provided in the reset email.';
} elseif($row['resetComplete'] == 'Yes') {
	$stop = 'Your password has already been changed!';
}

//if form has been submitted process it
if (isset($_POST['submit'])){
	if (! isset($_POST['password']) || ! isset($_POST['passwordConfirm']))
		$error[] = 'Both Password fields are required to be entered';

	//basic validation
	if (strlen($_POST['password']) < 3) $error[] = 'Password is too short.';
	if (strlen($_POST['passwordConfirm']) < 3) $error[] = 'Confirm password is too short.';
	if ($_POST['password'] != $_POST['passwordConfirm']) $error[] = 'Passwords do not match.';

	//if no errors have been created carry on
	if (! isset($error)){
		$controller->updatePassword($_POST['password'], $row['resetToken']);
		//redirect to index page
		header('Location: login.php?action=resetAccount');
		exit;
	}
}

//define page title
$title = 'Reset Account';

//include header template
require('layout/header.php'); 
?>

<section class="container">
	<section class="row">
	    <section class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	    	<?php
				if (isset($stop)) echo "<p class='bg-danger'>$stop</p>";
	    		else require_once('layout/views/vResetPassword.php');
			?>
		</section>
	</section>
</section>

<?php 
//include header template
require('layout/footer.php'); 
?>

<?php require('includes/config.php');

//if logged in redirect to members page
if ($user->is_logged_in()){ header('Location: memberpage.php'); exit(); }

//if form has been submitted process it
if (isset($_POST['submit'])){

	//Make sure all POSTS are declared
	if (! isset($_POST['email'])) $error[] = "Please fill out all fields";

	$row = $controller->getUserByEmail($_POST['email']);
	if ($row){
		if (empty($row['email'])) $error[] = 'Email provided is not recognised.';
	}
	else $error[] = 'Please enter a valid email address';

	//if no errors have been created carry on
	if (! isset($error)){
		$controller->updateToken($_POST['email']);
		//redirect to index page
		header('Location: login.php?action=reset');
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
			<?php require_once('layout/views/vReset.php'); ?>
		</section>
	</section>
</section>

<?php
//include header template
require('layout/footer.php');
?>

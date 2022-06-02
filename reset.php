<?php require('includes/config.php');

//if logged in redirect to members page
if ($user->is_logged_in()){ 
	header('Location: memberpage.php'); 
	exit(); 
}

//if form has been submitted process it
if (isset($_POST['submit'])){

	//Make sure all POSTS are declared
	if (! isset($_POST['email'])) {
		$error[] = "Please fill out all fields";
	}


	//email validation
	if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row['email'])){
			$error[] = 'Email provided is not recognised.';
		}

	}

	//if no errors have been created carry on
	if (! isset($error)){

		//create the activation code
		$token = md5(uniqid(rand(),true));

		try {

			$stmt = $db->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
			$stmt->execute(array(
				':email' => $row['email'],
				':token' => $token
			));

			//send email
			$to = $row['email'];
			$subject = "Password Reset";
			$body = "<p>Someone requested that the password be reset.</p>
			<p>If this was a mistake, just ignore this email and nothing will happen.</p>
			<p>To reset your password, visit the following address: <a href='".DIR."resetPassword.php?key=$token'>".DIR."resetPassword.php?key=$token</a></p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			header('Location: login.php?action=reset');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
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
			<?php require_once('./layout/views/vReset.php'); ?>
		</section>
	</section>
</section>

<?php
//include header template
require('layout/footer.php');
?>

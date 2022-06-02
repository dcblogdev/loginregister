<?php require('includes/config.php'); 

//if not logged in redirect to login page
if (! $user->is_logged_in()){ header('Location: login.php'); exit(); }

//define page title
$title = 'Member Page';

//include header template
require('layout/header.php'); 
?>

<section class="container">
<?php require_once('layout/views/vMemberPage.php'); ?>
</section>

<?php 
//include header template
require('layout/footer.php'); 
?>
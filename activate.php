<?php
require('includes/config.php');

//collect values from the url
$memberID = trim($_GET['x']);
$active = trim($_GET['y']);

//if id is number and the active token is not empty carry on
if (is_numeric($memberID) && !empty($active)) {
	if ($controller->updateActive($memberID, $active)){
		//redirect to login page
		header('Location: login.php?action=active');
		exit;
	} else echo "Your account could not be activated.";
}
?>
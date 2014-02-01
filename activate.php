<?php
require('includes/config.php');

$memberID = trim($_GET['x']);
$active = trim($_GET['y']);

if(is_numeric($memberID) && !empty($active)){
	//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
	$stmt = $db->prepare("UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active");
	$stmt->execute(array(
		':memberID' => $memberID,
		':active' => $active
	));
	if($stmt->rowCount() == 1){

		//redirect to login page
		header('Location: login.php?action=active');
		exit;

	} else {
		echo "Your account could not be activated."; 
	}
	
}
?>
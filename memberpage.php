<?php require('includes/config.php'); 

//if not logged in redirect to login page
if (! $user->is_logged_in()){
    header('Location: login.php'); 
    exit(); 
}

//define page title
$title = 'Member Page';

//include header template
require('layout/header.php'); 
?>

<div class="container">
                    <h3><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h3>
                    <p><a href="logout.php">Logout</a></p>

            <?php for($i=0; $i < 2; $i++){ ?>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis veritatis nemo ad recusandae labore nihil iure qui eum consequatur, officiis facere quis sunt tempora impedit ullam reprehenderit facilis ex amet!
            <?php } ?>
            
</div>

<?php 
//include header template
require('layout/footer.php'); 
?>
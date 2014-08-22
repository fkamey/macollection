<?php

// On charge la config et les librairies
include('../config/config.php');

// create a new TwitterAvatars object
$ta = new TwitterApp(new tmhOAuth($config));

// check our authentication status
if($ta->isAuthed()) {
  $success = true;
}
// did the user request authorization?
elseif(isset($_POST['auth'])) {

    // start authentication process
    $ta->auth();
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Connection</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  	
	<h1>Connection</h1>
  <?php if(isset($success)): ?>
      <h2>Connecté !</h2>
      <?php 
        echo 'your access_token : '.$_COOKIE['access_token'].'<br />'; 
        echo 'Your access_token_secret : '.$_COOKIE['access_token_secret'];
      ?>
  <?php elseif(isset($error)): ?>
      <p>Error. <a href="index.php">Try again?</a></p>
  <?php else: ?>
      <form action="" method="post">
      		<input type="hidden" value="1" name="auth" />
          <input type="image" src="img/sign-in-with-twitter-l.png"
                 alt="Connect to Twitter" name="auth" value="1">
      </form>
      <p>Connect to Twitter to use this app.</p>
  <?php endif; ?>
  
  </body>
</html>
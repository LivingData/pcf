<?php

require_once 'app/init.php';

$googleClient = new Google_Client;
$auth = new GoogleAuth($googleClient);

if($auth->checkRedirectCode())
{
  echo "die";
   die($_GET['code']);
  }


?>

<!doctype html>
<html>
      <head>
            <meta charset="utf-8">
            <title>Website</title>
      </head>
      <body> 
      <?php if(!$auth->isLoggedIn()): ?>
         <a href="<?php echo $auth->getAuthUrl(); ?>">Sign in with Google</a>
         <?php else: ?>
             You are signed in. <a href="logout.php">Sign out</a>
         
         <?php endif; ?>
      </body>
</html>

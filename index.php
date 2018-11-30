<?PHP
require_once("./include/tayfireconfig.php");

if(!$TayFireUsersite->CheckLogin())
{
    $TayFireUsersite->RedirectToURL("login.php");
    exit;
}

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>TAYFIRE</title>
  <meta name="description" content="TAYFIRE - The Blazing Social Media Network!">
  <meta name="author" content="Team TayFire!">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>

<body>
  <img src ="images/TayFireLogo.gif">
Welcome back <?= $TayFireUsersite->UserFirstName()." ".$TayFireUsersite->UserLastName(); ?>!
  <li><a href='register.php'>Register</a></li>
  <!--<li><a href='confirmreg.php'>Confirm registration</a></li>-->
  <li><a href='login.php'>Login</a></li>
  <li><a href='login-home.php'>View Posts</a></li>

</body>
</html>
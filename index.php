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
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>TAYFIRE</title>
  <meta name="description" content="TAYFIRE - The Blazing Social Media Network!">
  <meta name="author" content="Team TayFire!">

  <link rel="STYLESHEET" type="text/css" href="bootstrap/css/bootstrap.css" />

</head>

<body>
<div class="container">
  <img src ="images/TayFireLogo.gif">
Welcome back <?= $TayFireUsersite->UserFirstName()." ".$TayFireUsersite->UserLastName(); ?>!
  <li><a href='register.php'>Register</a></li>
  <!--<li><a href='confirmreg.php'>Confirm registration</a></li>-->
  <li><a href='login.php'>Login</a></li>
  <li><a href='login-home.php'>View Posts</a></li>
</div>
</body>
</html>
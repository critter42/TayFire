<?PHP
require_once("./include/tayfireconfig.php");

if(!$TayFireUsersite->CheckLogin())
{
    $TayFireUsersite->RedirectToURL("login.php");
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
	  <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Profile</title>
      <link rel="STYLESHEET" type="text/css" href="bootstrap/css/bootstrap.css" />
</head>
  <body>
    <div class='container'>
   	  <div>
	    <p>Your Profile</p>
      </div>
      <div>
        <p>Name: <?php echo $_SESSION['firstName_of_user']." ".$_SESSION['lastName_of_user']; ?>
        <br>Email: <?php echo $_SESSION['email_of_user']; ?>
        <br># Followers: <? echo $TayFireUsersite->GetFollowerCount($_SESSION['user_id_of_user']);?></p>
      </div>
      <div>
        <p>List followed users
        <br>List feeds</p>
      </div>
      <div>
        <p>Show number of posts
        <br>Show 5 most recent posts</p>
      </div>
      <div class='container'>
	    <input type='submit' name='Change E-mail' value='Change E-mail' />
	  </div>
      <div class='container'>
	    <input type='submit' name='Change Password' value='Change Password' />
	  </div>
	</div>
  </body>
</html>

<?PHP
require_once("./include/tayfireconfig.php");

if(isset($_POST['submitted']))
{
   if($TayFireUsersite->Login())
   {
        $TayFireUsersite->RedirectToURL("index.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
  <head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>TayFire Profile page</title>
	<link rel="STYLESHEET" type="text/css" href="style/tayfiresite.css" />
  </head>
  <body>
    <div class='container'>
   	  <div>
	    <p>Your Profile</p>
      </div>
      <div>
        <p>Show full name
        <br>Show e-mail
        <br>Show number of followers</p>
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

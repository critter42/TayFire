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
      <title>Home page</title>
      <link rel="STYLESHEET" type="text/css" href="style/tayfiresite.css">
</head>
<body>
<div id='tayfiresite_content'>
<h2>Home Page</h2>

Welcome back <?= $TayFireUsersite->UserFirstName()." ".$TayFireUsersite->UserLastName(); ?>!

<p><a href='change-pwd.php'>Change password</a></p>

<!-- <p><a href='access-controlled.php'>A sample 'members-only' page</a></p> -->
<br><br><br>
<p><a href='logout.php'>Logout</a></p>
</div>
<!--$TayFireUsersite->UserID()." ".$TayFireUsersite->UserEmail()." ".$TayFireUsersite->UserFirstName()." ".$TayFireUsersite->UserLastName();-->
<?=

$userid = $TayFireUsersite->UserID();

$posts = $this->GetUserPosts($userid);
if (!$posts) {
    trigger_error('Invalid query: ' . $conn->error);
}
if($posts->num_rows > 0) {
	while($row = $posts->fetch_assoc()) {
	    
	   echo $row["p_title"]." <br>" . $row["p_content"]." <br>";
	   echo "Comments";
	  
	 }
}
else {
    echo "No posts! <br>";
}
?>	
</body>
</html>

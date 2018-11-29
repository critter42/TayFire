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
<?PHP
$TayFireUsersite->UserFirstName();
$TayFireUsersite->UserID();
$qry = "SELECT p_title, p_content FROM Post where post_id = $TayFireUsersite->UserID()";
$result = mysqli_query($this->connection,$qry);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	   echo $row["p_title"]." <br>" . $row["p_content"]." <br>";
	 }
}
else {
    echo "No posts! <br>";
}
?>	
</body>
</html>

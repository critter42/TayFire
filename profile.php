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
<?php
if (empty($_GET['profileid'])){
	$profile_id = $_SESSION['user_id_of_user'];
}
else
{
	$profile_id = $_GET['profileid'];
        echo "<p>Name: ".$TayFireUsersite->GetNamefromID($profile_id);
        echo "<br>Email: ".$TayFireUsersite->GetEmailfromID($profile_id);
        echo "<br># Followers: ".$TayFireUsersite->GetFollowerCount($_SESSION['user_id_of_user'])."</p>";?>
      </div>
      <div>
        <p>People I follow:<br />
<?php
$followed = $TayFireUsersite->GetFollowerList($_SESSION['user_id_of_user']);
if ($followed->num_rows >0)
{
	while($row = $followed->fetch_assoc()){
		echo "<a href='profile.php?profileid=".$row["isFollowed_id"]."'>".$TayFireUsersite->GetNamefromID($row["isFollowed_id"])."<br />";
	}
}
else
{
	echo "I don't follow anyone yet";
}
?>
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

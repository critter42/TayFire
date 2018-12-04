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
	$isFollowed = $_SESSION['user_id_of_user'];
}
else
{
	$isFollowed = $_GET['profileid'];
}
$user = $_SESSION['user_id_of_user'];
if(isset($_POST['Follow']))
{
	$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
	$qry2 = "Select isFollowed_id,follower_id FROM Follow WHERE isFollowed_id ='".$isFollowed."' AND follower_id = '".$user."'";
	$result = mysqli_query($conn,$qry2);
	
	if (!$result || mysqli_num_rows($result)==0)
	{
		$qry = "Insert Into Follow (isFollowed_id,follower_id) VALUES('".$isFollowed."','".$user."')";
		$result2 = mysqli_query($conn,$qry);
		echo "<meta http-equiv='refresh' content='0'>";
	}
	else
	{
		$del = "DELETE FROM Follow WHERE isFollowed_id ='".$isFollowed."' AND follower_id = '".$user."'";
		$result3 = mysqli_query($conn,$del);
		echo "<meta http-equiv='refresh' content='0'>";
	}
}
if (empty($_GET['profileid'])){
	$profile_id = $_SESSION['user_id_of_user'];
}
else
{
	$profile_id = $_GET['profileid'];
}
        echo "<p>Name: ".$TayFireUsersite->GetNamefromID($profile_id);
        echo "<br>Email: ".$TayFireUsersite->GetUserEmailfromID($profile_id);
        echo "<br># Followers: ".$TayFireUsersite->GetFollowerCount($profile_id)."</p>";
		echo "<form id='newFollow' action='profile.php?profileid=".$profile_id."' method='post' accept-charset='UTF-8'><br />";
	   echo "    <div class='container'>";
	   echo " 		<input type='submit' name='Follow' value='Follow' />";
       echo "		</div>";
	   echo "     </form>";
?>

      </div>
      <div>
        <p>People I follow:<br />
<?php
if (empty($_GET['profileid'])){
	$profile_id = $_SESSION['user_id_of_user'];
}
else
{
	$profile_id = $_GET['profileid'];
}
$followed = $TayFireUsersite->GetFollowerList($profile_id);

if ($followed->num_rows >0)
{
	while($row = $followed->fetch_assoc()){
		echo "<a href='profile.php?profileid=".$row["isFollowed_id"]."'>".$TayFireUsersite->GetNamefromID($row["isFollowed_id"])."</a><br />";
	}
}
else
{
	echo "I don't follow anyone yet";
}
?>
        <br>My Feed</p>
<?=

$userid = $_GET['profileid'];
$username = $TayFireUsersite->UserFirstName();
$commenter = $_SESSION['user_id_of_user'];

$posts = $TayFireUsersite->GetUserFriendPosts($userid);
if(isset($_POST['Submit']))
	   {
			$postid = $_GET['postid']; 
			$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
			$qry = "Insert Into Comment (c_content,commenter_id,post_id) VALUES('".$_POST["comment"]."','".$commenter."','".$postid."')";
			$result = mysqli_query($conn,$qry);
			echo "<meta http-equiv='refresh' content='0'>";
		}
if(isset($_POST['Liked']))
{
	$postid = $_GET['postid']; 
	$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
	$qry2 = "Select post_id,liker_id FROM PostLikes WHERE post_id ='".$postid."' AND liker_id = '".$commenter."'";
	$result = mysqli_query($conn,$qry2);
	
	if (!$result || mysqli_num_rows($result)==0)
	{
		$postid = $_GET['postid']; 
		$qry = "Insert Into PostLikes (post_id,liker_id) VALUES('".$postid."','".$commenter."')";
		$result2 = mysqli_query($conn,$qry);
		echo "<meta http-equiv='refresh' content='0'>";
	}
	else
	{
		$postid = $_GET['postid']; 
		$del = "DELETE FROM PostLikes WHERE post_id ='".$postid."' AND liker_id = '".$commenter."'";
		$result3 = mysqli_query($conn,$del);
		echo "<meta http-equiv='refresh' content='0'>";
	}
}

if($posts->num_rows > 0) {
	while($row = $posts->fetch_assoc()) {
	    
	   echo "<a href='post.php?postid=".$row["post_id"]."'><b>".$row["p_title"]."</b></a><i> - <a href='profile.php?profileid=".$row["poster_id"]."'>".$TayFireUsersite->GetNamefromID($row["poster_id"])."</a></i><br/>".$row["p_content"]." <br />";
	   $likes = $TayFireUsersite->GetNumLikes($row["post_id"]);
	   echo "    LIKES: ".$likes."<form id='newComment' action='login-home.php?postid=".$row["post_id"]."' method='post' accept-charset='UTF-8'><br />";
	   echo "    <div class='container'>";
	   echo " 		<input type='submit' name='Liked' value='Liked' />";
       echo "		</div>";
	   echo "     </form>";
	   echo "<i>Comments</i> <br />";
	   $comments = $TayFireUsersite->GetComments($row["post_id"]);
	   $commenter = $_SESSION['user_id_of_user'];
       $postid = $row["post_id"];  
       

		echo "<form id='newComment".$row["post_id"]."' action='login-home.php?postid=".$row["post_id"]."' method='post' accept-charset='UTF-8'>";
		echo "<fieldset >";
		echo "<legend>Add Comment</legend>";

		echo "<input type='hidden' name='submitted' id='submitted' value='1'/>";

		echo "<div><span class='error'>".$TayFireUsersite->GetErrorMessage()."</span></div>";
		echo "<div class='container'>";
		echo "    <label for='comment' >Comment*: </label><br/>";
		echo "   <input type='text' name='comment' id='comment' value='".$TayFireUsersite->SafeDisplay('comment')."' maxlength='1250' /><br/>";
		echo "    <span id='register_name_errorloc' class='error'></span>";
		echo "</div>";
		echo "<div class='container'>";
		echo "   <input type='submit' name='Submit' value='Submit' />";
		echo "</div>";

		echo "</fieldset>";
		echo "</form>";
		echo "<center><img src=\"../bootstrap/img/rainbow.gif\"></center>";
	 }
}
else {
    echo "No posts! <br />";
}

?>	
      </div>
      <div>
        <p>Show number of posts
        <br>Show 5 most recent posts</p>
      </div>
<p><a href='logout.php'>Logout</a></p>
<p><a href='change-pwd.php'>Change password</a></p>
	</div>
  </body>
</html>

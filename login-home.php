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
      <title>Home page</title>
      <link rel="STYLESHEET" type="text/css" href="bootstrap/css/bootstrap.css" />
</head>
<body>
<div class="container">
<h2><?= $TayFireUsersite->UserFirstName(); ?>'s Posts!</h2>

<!-- <p><a href='access-controlled.php'>A sample 'members-only' page</a></p> -->
<br><br><br>


<?=

$userid = $TayFireUsersite->UserID();
$username = $TayFireUsersite->UserFirstName();
$commenter = $_SESSION['user_id_of_user'];
$postid = $_GET['postid']; 
$posts = $TayFireUsersite->GetUserPosts($userid);
if(isset($_POST['Submit']))
	   {
			$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
			$qry = "Insert Into Comment (c_content,commenter_id,post_id) VALUES('".$_POST["comment"]."','".$commenter."','".$postid."')";
			$result = mysqli_query($conn,$qry);
			//echo "<meta http-equiv='refresh' content='0'>";
		}
if(isset($_POST['Liked']))
{
	$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
	$qry2 = "Select post_id,liker_id FROM PostLikes WHERE post_id ='".$postid."' AND liker_id = '".$commenter."'";
	$result = mysqli_query($conn,$qry2);
	
	if (!$result || mysqli_num_rows($result)==0)
	{
		$qry = "Insert Into PostLikes (post_id,liker_id) VALUES('".$postid."','".$commenter."')";
		$result2 = mysqli_query($conn,$qry);
		echo "<meta http-equiv='refresh' content='0'>";
	}
	else
	{
		$del = "DELETE FROM PostLikes WHERE post_id ='".$postid."' AND liker_id = '".$commenter."'";
		$result3 = mysqli_query($conn,$del);
		echo "<meta http-equiv='refresh' content='0'>";
	}
}

if($posts->num_rows > 0) {
	while($row = $posts->fetch_assoc()) {
	    
	   echo "<a href='post.php?postid=".$row["post_id"]."'><b>".$row["p_title"]."</b></a><i> - ".$TayFireUsersite->GetNamefromID($userid)."</i><br/>".$row["p_content"]." <br />";
	   $likes = $TayFireUsersite->GetNumLikes($row["post_id"]);
	   echo "    LIKES: ".$likes."<form id='newComment' action='login-home.php?postid=".$postid."' method='post' accept-charset='UTF-8'><br />";
	   echo "    <div class='container'>";
	   echo " 		<input type='submit' name='Liked' value='Liked' />";
       echo "		</div>";
	   echo "     </form>";
	   echo "<i>Comments</i> <br />";
	   $comments = $TayFireUsersite->GetComments($row["post_id"]);
	   $commenter = $_SESSION['user_id_of_user'];
       $postid = $row["post_id"];  
       

		echo "<form id='newComment".$postid."' action='login-home.php?postid=".$postid."' method='post' accept-charset='UTF-8'>";
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
<p><a href='logout.php'>Logout</a></p>
<p><a href='change-pwd.php'>Change password</a></p>
</div>
</body>
</html>

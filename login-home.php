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

$posts = $TayFireUsersite->GetUserPosts($userid);


if($posts->num_rows > 0) {
	while($row = $posts->fetch_assoc()) {
	    
	   echo "<a href='post.php?postid=".$row["post_id"]."'><b>".$row["p_title"]."</b> <br /></a>" . $row["p_content"]." <br />";
	   $likes = $TayFireUsersite->GetNumLikes($row["post_id"]);
	   echo "    LIKES: ".$likes."<br />";
	   echo "<i>Comments</i> <br />";
	   $comments = $TayFireUsersite->GetComments($row["post_id"]);
	   $commenter = $_SESSION['user_id_of_user'];
       $postid = $row["post_id"];  
       if(isset($_POST['Submit']))
	   {
			$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
			$qry = "Insert Into Comment (c_content,commenter_id,post_id) VALUES('".$_POST["comment"]."','".$commenter."','".$postid."')";
			$result = mysqli_query($conn,$qry);
			echo "<meta http-equiv='refresh' content='0'>";
		}

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

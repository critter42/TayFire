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
      <title>Post</title>
      <link rel="STYLESHEET" type="text/css" href="bootstrap/css/bootstrap.css" />
</head>
<body>
<div class="container">
<?php 
$postid = $_GET['postid']; 
$post = $TayFireUsersite->GetPost($postid);
$commenter = $_SESSION['user_id_of_user'];
if(isset($_POST['Liked']))
{
	$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
	$qry2 = "Select post_id,liker_id FROM PostLikes WHERE post_id ='".$postid."' AND liker_id = '".$commenter."'";
	$result = mysqli_query($conn,$qry);
	
	if(!result || mysqli_num_rows <= 0)
	{
		$qry = "Insert Into PostLikes (post_id,liker_id) VALUES('".$postid."','".$commenter."')";
		$result2 = mysqli_query($conn,$qry);
		echo "<meta http-equiv='refresh' content='0'>";
	}
	else
	{
		$del = "DELETE FROM PostLikes WHERE post_id ='".$postid."' AND liker_id = '".$commenter."'";
		$result3 = mysqli_query($conn,$qry);
		echo "<meta http-equiv='refresh' content='0'>";
	}
		
if($post->num_rows > 0) {
	while($row = $post->fetch_assoc()) {
	    
	   echo "<a href='post.php?postid=".$row["post_id"]."'><b>".$row["p_title"]."</b> <br /></a>" . $row["p_content"]." <br />";
	   $likes = $TayFireUsersite->GetNumLikes($row["post_id"]);
	   echo "    LIKES: ".$likes."<form id='newComment' action='post.php?postid=".$postid."' method='post' accept-charset='UTF-8'><br />";
	   echo "    <div class='container'>";
	   echo " 		<input type='submit' name='Liked' value='Liked' />";
       echo "		</div>";
	   echo "     </form>";
	   echo "<i>Comments</i> <br />";
	   $comments = $TayFireUsersite->GetComments($row["post_id"]);
	   echo "<center><img src=\"../bootstrap/img/rainbow.gif\"></center>";
	 }
}
?>
<?php
$commenter = $_SESSION['user_id_of_user'];
$postid = $_GET['postid'];  
if(isset($_POST['Submit']))
{
	$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
	$qry = "Insert Into Comment (c_content,commenter_id,post_id) VALUES('".$_POST["comment"]."','".$commenter."','".$postid."')";
	$result = mysqli_query($conn,$qry);
	echo "<meta http-equiv='refresh' content='0'>";
}

?>
<form id='newComment' action="<?php echo "post.php?postid=".$postid; ?>" method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Add Comment</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div><span class='error'><?php echo $TayFireUsersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='comment' >Comment*: </label><br/>
    <input type='text' name='comment' id='comment' value='<?php echo $TayFireUsersite->SafeDisplay('comment') ?>' maxlength="1250" /><br/>
    <span id='register_name_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    
    var frmvalidator  = new Validator("comment");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("comment","req","Please provide a comment");
	


// ]]>
</script>
</div>
</body>
</HTML>
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
      <title>Post</title>
      <link rel="STYLESHEET" type="text/css" href="style/tayfiresite.css">
</head>
<body>
<div id='tayfiresite_content'>
<?= 
$postid = $_GET['postid']; 
$post = $TayFireUsersite->GetPost($postid);
if($post->num_rows > 0) {
	while($row = $post->fetch_assoc()) {	    
	   echo $row["p_title"]." <br /></a>" . $row["p_content"]." <br />";
	   echo "Comments <br />";
	   $comments = $TayFireUsersite->GetComments($row["post_id"]);

	 }
}?></h2>
<?=
$commenter = $_SESSION['user_id_of_user'];
$postid = $_GET['postid'];  
if(isset($_POST['submit']))
{
	$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
	$qry = "Insert Into Comment (c_content,commenter_id,post_id) VALUES('".$_POST["comment"]."','".$commenter."','".$postid."'";
	$result = mysqli_query($conn,$qry);
}
echo "<form id='newComment' action='post.php?postid=".$postid."' method='post' accept-charset='UTF-8'>"; ?>
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



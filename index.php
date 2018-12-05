<?PHP
require_once("./include/tayfireconfig.php");

if(!$TayFireUsersite->CheckLogin())
{
    $TayFireUsersite->RedirectToURL("login.php");
    exit;
}

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>TAYFIRE</title>
  <meta name="description" content="TAYFIRE - The Blazing Social Media Network!">
  <meta name="author" content="Team TayFire!">

  <link rel="STYLESHEET" type="text/css" href="bootstrap/css/bootstrap.css" />

</head>

<body>
<?php
$userid = $_SESSION['user_id_of_user'];
if(isset($_POST['NewPost']))
	{
		$conn  = mysqli_connect("localhost","TayFire","T4yF1r3!","TayFire");
		$qry = "INSERT INTO Post (poster_id, p_title, p_content) VALUES (".$userid.",'".$_POST["title"]."','".$_POST["body"]."')";
		$result = mysqli_query($conn,$qry);
		//echo "<meta http-equiv='refresh' content='0'>";
	}	
?>
<div class="container">
  <img src ="images/TayFireLogo.gif">
Welcome back <?= $TayFireUsersite->UserFirstName()." ".$TayFireUsersite->UserLastName(); ?>!
  <!--<li><a href='register.php'>Register</a></li>-->
  <!--<li><a href='confirmreg.php'>Confirm registration</a></li>-->
  <!--<li><a href='login.php'>Login</a></li>-->
  <li><a href='login-home.php'>View Posts</a></li>
  <li><a href='profile.php?profileid=<?php echo $_SESSION['user_id_of_user']; ?>'>Your Profile</a>
 <?php
		echo "<form id='NewPost' action='index.php' method='post' accept-charset='UTF-8'>";
		echo "<fieldset >";
		echo "<legend>New Post</legend>";

		echo "<input type='hidden' name='submitted2' id='submitted2' value='2'/>";

		echo "<div><span class='error'>".$TayFireUsersite->GetErrorMessage()."</span></div>";
		echo "<div class='container'>";
		echo "    <label for='title' >Title*: </label><br/>";
		echo "   <input type='text' name='title' id='title' value='".$TayFireUsersite->SafeDisplay('title')."' maxlength='1250' /><br/>";
		echo "    <span id='register_name_errorloc' class='error'></span>";
		echo "</div>";
		echo "<div class='container'>";
		echo "    <label for='title' >Body*: </label><br/>";
		echo "   <input type='text' name='body' id='body' value='".$TayFireUsersite->SafeDisplay('body')."' maxlength='1250' /><br/>";
		echo "    <span id='register_name_errorloc' class='error'></span>";
		echo "</div>";
		echo "<div class='container'>";
		echo "   <input type='submit' name='NewPost' value='NewPost' />";
		echo "</div>";

		echo "</fieldset>";
		echo "</form>";
?>
</div>
</body>
</html>
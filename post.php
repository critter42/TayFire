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
<?= 
$postid = $_GET['postid']; 
$post = $TayFireUsersite->GetPost($postid);
if($posts->num_rows > 0) {
	while($row = $posts->fetch_assoc()) {	    
	   echo $row["p_title"]." <br /></a>" . $row["p_content"]." <br />";
	   echo "Comments <br />";
	   $comments = $TayFireUsersite->GetComments($row["post_id"]);

	 }
}?></h2>
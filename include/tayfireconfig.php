<?PHP
require_once("./include/tayfiremembers.php");

$tayfiremembers = new TayfireUsersite();

//Provide your site name here
$tayfiremembers->SetWebsiteName('tayfire.com');

//Provide the email address where you want to get notifications
$tayfiremembers->SetAdminEmail('dchmbrln@memphis.edu');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$tayfiremembers->InitDB(/*hostname*/'localhost',
                      /*username*/'TayFire',
                      /*password*/'T4yF1r3!',
                      /*database name*/'TayFireDev',
                      /*table name*/'Users');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$tayfiremembers->SetRandomKey('QAAucYfpdlHyTGA');

?>
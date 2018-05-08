<?php
ob_start("ob_gzhandler");
error_reporting(0);
session_start();

/* DATABASE CONFIGURATION */
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'ravexcha_wall');
// define('DB_PASSWORD', 'J78MbCWpQ=wr');
// define('DB_DATABASE', 'ravexcha_wallscript');
// define("BASE_URL", "http://www.ravexchange.co/");
// define("API_BASE_URL", "http://www.ravexchange.co/wallscript/");
// define("UPLOAD_PATH", "uploads/");

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'wallscript');
define("BASE_URL", "http://ravexchange.local/");
define("API_BASE_URL", "http://ravexchange.local/");
define("UPLOAD_PATH", "uploads/");


function getDB() 
{
	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->exec("set names utf8");
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
/* DATABASE CONFIGURATION END */


/* WALL ADMIN */
$base_url=BASE_URL;
$upload_path = UPLOAD_PATH;  // Updates images path
$admin_path = "../".$upload_path;
$admin_base_url=$base_url.'WallAdmin/';

/* Oauth Login */
require('oauth_login/oauth_config.php');


/*SMTP CONFIGURATIONS */
define("SMTP_CONNECTION", "0"); //On "1" Off "0"
define("SMTP_USERNAME", "steven@ravexchange.com");
define("SMTP_PASSWORD", "KwMpBUfnGxSFEjdA");
define("SMTP_HOST", "smtp-relay.sendinblue.com");
define("SMTP_PORT", "587");
define("SMTP_FROM_EMAIL", "dennis@ravexchange.co"); //Your website supprot email.
define("SMTP_FROM_TITLE", "Ravexchange Support"); //eg: Support WebsiteName
/*SMTP CONFIGURATIONS END*/
/*SITE DETAILS */
function siteDetails()
{
	$db = getDB();
	$stmt = $db->prepare("SELECT applicationName,applicationDesc,applicationToken FROM configurations WHERE con_id='1'");  
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_OBJ);
	$data = json_decode(json_encode($row),true);
	$db = null;
	return $data;
}

$siteData=siteDetails();
define("SITE_KEY", $siteData['applicationToken']);
define("SITE_NAME", $siteData['applicationName']);
define("SITE_DESC", $siteData['applicationDesc']);
/*SITE DETAILS END*/
function templateOrderData()
{
	$db = getDB();
	$stmt = $db->prepare("SELECT t_id,t_name,t_file,t_order FROM template ORDER BY t_order ASC");  
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_OBJ);
	$data = json_decode(json_encode($row),true);
	$db = null;
	return $data;
}

$home=0;$friends=0;$views=0;$groups=0;$otherGroups='';$notifications=0;$settings=0;$messages=0;$changePassword=0;$usernameValue=0;
?>

<?php
/*
* OAuth Login Configurations
* Srinivas Tamada www.9lessons.info www.thewallscript.com www.oauthlogin.com
*/

//ob_start("ob_gzhandler");
//error_reporting(0);
session_start();
define("OAuth_Base_URL", "http://yourwebsite.com/"); // Your Domain Name

$index=OAuth_Base_URL.'index.php'; //redirect to login page
$home=OAuth_Base_URL.'home.php';  //your login page welcome.php 

/* DATABASE CONFIGURATION */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'username');
define('DB_PASSWORD', 'password');
define('DB_DATABASE', 'database');

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

//Facebook
define('Facebook_App_ID', 'Your_Facebook_App_ID');
define('Facebook_App_Secret', 'Your_Facebook_App_Secret');
define('Facebook_Version', '2.8');

//Google
define('Google_Client_ID', 'Your_Google_Client_ID');
define('Google_Client_Secret', 'Your_Google_Client_Secret');
define('Google_Version', '1');

//Microsoft
define('Microsoft_Client_ID', 'Your_Microsoft_Client_ID');
define('Microsoft_Client_Secret', 'Your_Microsoft_Client_Secret');
define('Microsoft_Version', '5.0');

//Github
define('Github_Client_ID', 'Your_Github_Client_ID');
define('Github_Client_Secret', 'Your_Github_Client_Secret');


//LinkedIn
define('LinkedIn_Client_ID', 'Your_LinkedIn_Client_ID');
define('LinkedIn_Client_Secret', 'Your_LinkedIn_Client_Secret');
define('LinkedIn_Version', '1');


require('oauthLogin.php');
$oauthLogin = new oauthLogin();
?>
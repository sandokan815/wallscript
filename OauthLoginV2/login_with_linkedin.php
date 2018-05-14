<?php
require('oauth_config.php');
require('oauth_lib/http.php');
require('oauth_lib/oauth_client.php');

$client = new oauth_client_class;
$client->debug = false;
$client->debug_http = true;
$client->server = 'LinkedIn';
$client->redirect_uri = OAuth_Base_URL.'login_with_linkedin.php';


if(defined('OAUTH_PIN'))
$client->pin = OAUTH_PIN;

$client->client_id = LinkedIn_Client_ID;
$application_line = __LINE__;
$client->client_secret = LinkedIn_Client_Secret;

/*  API permission scopes
*  Separate scopes with a space, not with +
*/
$client->scope = 'r_basicprofile r_emailaddress';

if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0){
    die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
    'create an application, set the client_id to Consumer key and client_secret with Consumer secret. '.
    'The Callback URL must be '.$client->redirect_uri);
}


if(($success = $client->Initialize()))
{
    if(($success = $client->Process()))
    {
        if(strlen($client->access_token))
        {
            $success = $client->CallAPI(
            'https://api.linkedin.com/v'.LinkedIn_Version.'/people/~',
            'GET', array(
            'format'=>'json'
            ), array('FailOnAccessError'=>true), $user);
            
            /*
            * Use this if you just want to get the LinkedIn user email address
            */
            
            $success_email = $client->CallAPI(
            'https://api.linkedin.com/v'.LinkedIn_Version.'/people/~/email-address',
            'GET', array(
            'format'=>'json'
            ), array('FailOnAccessError'=>true), $email);
            
        }
    }
    $success = $client->Finalize($success_email);
}
if($client->exit)
exit;
if(strlen($client->authorization_error))
{
    $client->error = $client->authorization_error;
    $success = false;
}
if($success)
{
    
    $user->email = $email;
    $result=$oauthLogin->userSignup($user,'linkedin');
    require 'oauth_redirect.php';
    
}
else
{
    header("Location: $index");
    //echo "<script>window.location.href='".$index."'</script>";
    
}

?>
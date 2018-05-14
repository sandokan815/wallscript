<?php
//Sample Index Page
require('oauth_config.php');
if(!empty($_SESSION['userSession']))
{
header("Location:$home");
//echo "<script>window.location.href='".$home."'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>OAuth Login Demo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://lipis.github.io/bootstrap-social/assets/css/font-awesome.css" rel="stylesheet">
        <link href="oauth_button_css/bootstrap-social.css" rel="stylesheet" >
       
    </head>
    <body>
<div id="container">
<h1>Oauth Login Demo</h1>

<a class="btn btn-block btn-social btn-facebook" href="login_with_facebook.php">
<span class="fa fa-facebook"></span> Sign in with Facebook
</a>

<a class="btn btn-block btn-social btn-google" href="login_with_google.php">
<span class="fa fa-google"></span> Sign in with Google
</a>

<a class="btn btn-block btn-social btn-github" href="login_with_github.php">
<span class="fa fa-github"></span> Sign in with Github
</a>

<a class="btn btn-block btn-social btn-microsoft" href="login_with_microsoft.php">
<span class="fa fa-windows"></span> Sign in with Microsoft
</a>

<a class="btn btn-block btn-social btn-linkedin" href="login_with_linkedin.php">
<span class="fa fa-linkedin"></span> Sign in with LinkedIn
</a>
</div>



    
    </body>
</html>
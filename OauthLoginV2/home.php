<?php
//Sample Home Page
require('oauth_config.php');
if(empty($_SESSION['userSession']))
{
header("Location:$index");
//echo "<script>window.location.href='".$index."'</script>";
}
// User Data
$userData=$oauthLogin->userDetails($_SESSION['userSession']);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>OAuth Login Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href="https://lipis.github.io/bootstrap-social/assets/css/font-awesome.css" rel="stylesheet">
        <link href="oauth_button_css/bootstrap-social.css" rel="stylesheet" >
    </head>
    <body>
    <div id="home">
    <h1>Welcome to <?php echo $userData->name; ?></h1>
    <pre>
    <?php 
    echo "<h2>Name: ".$userData->name."</h2>";
    echo "<h2>Email: ".$userData->email."</h2>";
    echo "<h2>Gender: ".$userData->gender."</h2>";
    echo "<h2>Picture: <img src='".$userData->picture."' class='avatar'/></h2>";
    
    print_r($userData); 
    
    ?>
    </pre>
    <a href="logout.php" id="logout">Logout</a>
    </div>
    </body>
</html>
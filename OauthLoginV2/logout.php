<?php
require('oauth_config.php');
$_SESSION['userSession']=''; 
if(session_destroy())
{
unset($_SESSION['userSession']);
header("Location: $index");
//echo "<script>window.location.href='".$index."'</script>";
}
<?php
if($result)
{
$_SESSION['userSession']=$result->id;
header("Location:$home");
//echo "<script>window.location.href='".$home."'</script>";
}
else
{
header("Location:$index");
//echo "<script>window.location.href='".$index."'</script>"; 
}
?>
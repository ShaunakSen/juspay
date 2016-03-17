<?php
session_start();
function redirect_to($url)
{
    header('Location: '.$url);
}

if(isset($_SESSION["email"]))
{
    $login="true";
    $fname=$_SESSION["fname"];
    $lname=$_SESSION["lname"];
    $_SESSION = array();
    session_destroy();
}
redirect_to("index.php");
?>



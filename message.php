<?php
$message="";
$msg=preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if($msg=="activation_failure")
{
    $message="<h2>Activation Error</h2><p>Sorry there seems to have been an issue activating
                your account at this time. We have already notified ourselves of this issue and we
                will contact you via email when we have identified the issue</p>";

}
else if($msg=="activation_success"){
    $message='<h2>Activation success</h2><p>Your Account is now active<br>
                <a href="index.php">Click Here to go back to our homepage to Login</a></p>';
}

else
{
    $message=$msg;
}
?>
<div><? echo $message; ?></div>
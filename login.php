<?php
require_once("resources/config.php");
function redirect_to($url)
{
    header('Location: '.$url);
}


// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if (isset($_POST["e"])) {
    $e = escape_string($_POST['e']);
    $p = md5($_POST['p']);
    if ($e == "" || $p == "") {
        echo "login_failed";
        exit();
    } else {
        $query = query("SELECT * FROM users_registered WHERE email='$e' AND activated='1' LIMIT 1");
        confirm($query);
        $user_check = mysqli_num_rows($query);
        $row = fetch_array($query);
        $user_id = $row['id'];
        $user_first_name = $row['first_name'];
        $user_last_name = $row['last_name'];
        $user_email = $row['email'];
        $user_password = $row['password'];
        if ($p != $user_password) {
            echo "login_failed";
            exit();
        } else {
            $_SESSION['user_id'] = $user_id;
            $_SESSION["fname"] = $user_first_name;
            $_SESSION["lname"] = $user_last_name;
            $_SESSION['email'] = $user_email;
            exit();
        }

    }

}
?>
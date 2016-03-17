<?php
require_once("resources/config.php");
?>

<html>
<head>
    <title></title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/preloader.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/profile.css"/>
</head>
<body>

<div class="container-fluid">
    <div class="row banner">
        Hello Shaunak Sen
    </div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>

    window.addEventListener("load", function () {
        $('body').addClass('loaded');
        console.log('ok');
    });
</script>
</body>
</html>
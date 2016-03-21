<?php
require_once("resources/config.php");
require_once("resources/functions.php");
function redirect_to($url)
{
    header('Location: ' . $url);
}

if (isset($_POST["e"]) && (isset($_POST['fn']))) {
    // CONNECT TO THE DATABASE
    $e = escape_string($_POST['e']);
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $fn = escape_string($fn);
    $ln = escape_string($ln);
    $text = escape_string($_POST['text']);
    if ($e == "" || $fn == "" || $ln == "" || $text == "") {
        echo "The form submission is missing values.";
        exit();
    } else {
        //start of mail
        /*
        $to = "$e";
        $from = "Meetutu Care";
        $subject = 'Meetutu Account Activation';
        $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>
                    Meetutu System Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
                    <div style="padding:10px; background:#333; font-size:24px; color:#CCC;">
                    <a style="color: #c3c0b9; text-decoration: none" href="http://shaunakjuspay.esy.es">
                    Meetutu Account Information</a></div>
                    <div style="padding:24px; font-size:17px;">Hello ' . $fn . ' ' . $ln . ',<br /><br />
                    Click the link below to activate your account when ready:<br /><br />
                    <a href="http://shaunakjuspay.esy.es/activation.php?id=' . $uid . '&e=' . $e . '&p=' . $p_hash . '">Click here to activate your account now</a>
                    <br /><br />Login after successful activation using your:<br />* E-mail Address: <b>' . $e . '</b></div></body></html>';
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail($to, $subject, $message, $headers);
        */
        echo "send_success";
        exit();
    }
    exit();
}

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/start2.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/preloader.css">
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="demo loading">
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<div class="wrapper">
    <div class="flex-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#search" class="smoothScroll">Select a Mentor</a></li>
            <li><a href="#dates" class="smoothScroll">Select your dates</a></li>
            <? if (isset($_SESSION['email']))
                echo '<li><a href="logout.php">Log Out</a></li>'
            ?>
            <li class="social">
                <a href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
            </li>
            <li class="social">
                <a href="http://facebook.com/"><i class="fa fa-facebook"></i></a>
            </li>
            <li class="social">
                <a href="http://github.com/"><i class="fa fa-github"></i></a>
            </li>
            <li class="social">
                <a href="http://instagram.com/"><i class="fa fa-instagram"></i></a>
            </li>
        </ul>
    </div>
</div>

<div class="container-fluid">
    <br>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 welcome-message">
            <? if (isset($_SESSION['email']))
                echo "Hi...{$_SESSION['fname']} {$_SESSION['lname']}";
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row">
        <div class="col-xs-3"></div>

        <div class="col-xs-6 header-card">Showing teachers with similar preferences</div>
        <div class="col-xs-3"></div>

    </div>
    <hr>
    <div class="row">
        <div class="col-xs-3"></div>

        <div class="col-xs-6 header-message">Select a teacher below and send him an email
        <hr>
            We will contact you soon after that<br>
        </div>
        <div class="col-xs-3"></div>

    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 search-header"><?
            if(isset($_POST['subject']) && $_POST['subject']!="")
            {
                echo 'Displaying results for teachers teaching: <span class="individual-subject">'.$_POST['subject'].'</span> or teachers located at <span class="individual-subject-back">'.$_POST['destination'].'</span>';
            }
            ?>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="row">
        <?php
        if (isset($_POST['subject'])) {
            $subject = strtolower($_POST['subject']);
            $destination = $_POST['destination'];
            $sql = "SELECT * FROM teachers WHERE LOWER(teaches) LIKE '%{$subject}%' OR location LIKE '%{$destination}%'";
            $query = query($sql);
            confirm($query);
            while ($row = mysqli_fetch_assoc($query)) {
                $name = $row['first_name'] . ' ' . $row['last_name'];
                $subjects = $row['teaches'];
                $locations = $row['location'];
                $email = $row['email'];
                $individual_locations = explode(";", $locations);
                $individual_subjects = explode(";", $subjects);

                echo '<div class="col-sm-4">
                            <div class="card hoverable" data-email=' . $email . '>
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="activator" src="http://placehold.it/350x150">
                                </div>
                                <div class="card-content">
                                    <blockquote class="activator teacher">' . $name . '<i class="material-icons right"
                                                                                        style="cursor: pointer">more_vert</i>

                                        <p class="subjects">Teaches:';
                for ($i = 0; $i < count($individual_subjects); ++$i) {
                    if ($individual_subjects[$i] != ';') {
                        echo '<div class="individual-subject">' . $individual_subjects[$i] . '</div>';
                    }
                }

                echo '<p class="subjects">Located at:';
                for ($i = 0; $i < count($individual_locations); ++$i) {
                    if ($individual_locations[$i] != ';') {
                        echo '<div class="individual-subject-back">' . $individual_locations[$i] . '</div>';
                    }
                }

                echo '</p></blockquote><div class="select-teacher" data-email="' . $email . '">  <a class="btn-floating btn-large waves-effect waves-light done-button"><i class="material-icons">done</i></a>
</div>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4">'.$name.'<i
                                            class="material-icons right">close</i></span>

                                    <p>Location: 89 Dum Dum Park Kolkata 700055</p>

                                    <p><i class="fa fa-phone "></i>&nbsp;8481900767</p>

                                    <p><i class="fa fa-envelope "></i>&nbsp;' . $email . '</p>
                                </div>
                            </div>
                        </div>';
            }
        }
        ?>
    </div>
</div>

<a name="search">
    <div class="border-top"></div>
</a>
<br><br>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="form-container">
            <br>

            <form onsubmit="return false">
                <div class="row" id="scrollHere">
                    <div class="col-xs-1"></div>
                    <div class="input-field col-xs-4">
                        <input id="first_name" type="text" class="validate" value="<? if(isset($_SESSION['email'])) echo $_SESSION['fname'] ?>">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="input-field col s4">
                        <input id="last_name" type="text" class="validate" value="<? if(isset($_SESSION['email'])) echo $_SESSION['lname'] ?>">
                        <label for="last_name">Last Name</label>
                    </div>
                    <div class="col-xs-1"></div>
                </div>
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="input-field col-xs-9">
                        <input id="email" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-9">
                        <textarea class="message" id="textarea-message" placeholder="ENTER YOUR MESSAGE"></textarea>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-4">
                        <button class="btn waves-effect waves-light" type="submit" name="action" id="send-button"
                                onclick="sendMail()">
                            Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                    <div class="col-xs-7" id="status"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script>
    window.addEventListener("load", function () {
        $('body').addClass('loaded');
        console.log('ok');
    });

    $('.select-teacher').on('click', function (e) {
        e.preventDefault();
        var email = $(this).attr('data-email');
        console.log(email);
        $('html, body').animate({
            scrollTop: $("#scrollHere").offset().top
        }, 600);
        $('#email').focus();
        $('#email').val(email);
    });

    function sendMail() {
        var fn = _('first_name').value;
        var ln = _('last_name').value;
        var e = _("email").value;
        var text = _('textarea-message').value;

        if (e == "" || fn == "" || ln == "" || text == "") {
            _("status").innerHTML = "Please fill out all of the form data";
        }
        else {
            _("send-button").style.display = "none";
            _("status").innerHTML = "please wait";
            var ajax = ajaxObj("POST", "start5.php");
            ajax.onreadystatechange = function () {
                if (ajaxReturn(ajax) == true) {
                    if (ajax.responseText.trim() != "send_success") {
                        _("status").innerHTML = ajax.responseText;
                        _("send-button").style.display = "block";
                    }
                    else {
                        _("status").innerHTML = "Ok.. mail sent.. We will get back to you shortly"
                    }
                }
            }
            ajax.send("fn=" + fn + "&ln=" + ln + "&e=" + e + "&text=" + text);
        }
    }


</script>

</body>
</html>
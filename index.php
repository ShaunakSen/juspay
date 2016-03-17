<?php
require_once("resources/config.php");
?>

<?php
if (isset($_POST["emailcheck"])) {
    $email = escape_string($_POST['emailcheck']);
    $query = query("SELECT * FROM users_registered WHERE email='$email' LIMIT 1");
    confirm($query);
    $email_check = mysqli_num_rows($query);

   if ($email_check == 1) {
        echo '<span style="color: #b42a11">You are already registered in This Site. Log in <a href="#" style="color: #122b40">Here</a></span>';
        exit();
    } else {
        echo '<span style="color: #006400">' . $email . ' is Ok</span>';
        exit();
    }
}


// Ajax calls this REGISTRATION code to execute
if (isset($_POST["e"]) && !(isset($_POST['id']))) {
    // CONNECT TO THE DATABASE
    $e = escape_string($_POST['e']);
    $p = $_POST['p'];
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $fn = escape_string($fn);
    $ln = escape_string($ln);
    $query = query("SELECT * FROM users_registered WHERE email = '$e' LIMIT 1");
    confirm($query);
    $already_registered_check = mysqli_num_rows($query);
    // FORM DATA ERROR HANDLING
    if ($e == "" || $p == "" || $fn == "" || $ln == "") {
        echo "The form submission is missing values.";
        exit();
    } else if ($already_registered_check > 0) {
        echo "You have already registered in our site. Please proceed to Log In Page";
        exit();
    } else if (strlen($p) <= 7) {
        echo "your password is too short";
        exit();

    } else {
        // END FORM DATA ERROR HANDLING
        // Begin Insertion of data into the database
        // Hash the password and apply your own mysterious unique salt

        $p_hash = md5($p);
        // Add user info into the database table for the main site table
        $query = query("INSERT INTO users_registered (first_name,last_name,email, password) VALUES('$fn','$ln','$e','$p_hash')");
        confirm($query);
        $uid = get_id();
        echo '<a href="activation.php?id=' . $uid . '&e=' . $e . '&p=' . $p_hash . '">Click here </a>';
        /*start of mail
        $to = "$e";
        $from = "auto_responder@shaunakmysql.webege.com";
        $subject = 'yoursitename Account Activation';
        $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>
                    yoursitename Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
                    <div style="padding:10px; background:#333; font-size:24px; color:#CCC;">
                    <a href="http://www.yoursitename.com">
                    <img src="http://www.yoursitename.com/images/logo.png" width="36" height="30" alt="yoursitename"
                     style="border:none; float:left;"></a>yoursitename Account Activation</div>
                     <div style="padding:24px; font-size:17px;">Hello ' . $u . ',<br /><br />
                     Click the link below to activate your account when ready:<br /><br />
                     <a href="localhost/series/hall2/public/activation.php?id=' . $uid .  '&e=' . $e . '&p=' . $p_hash . '">Click here to activate your account now</a>
                     <br /><br />Login after successful activation using your:<br />* E-mail Address: <b>' . $e . '</b></div></body></html>';
        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail($to, $subject, $message, $headers);
        */
        echo "signup_success";
        exit();
    }
    exit();
}


if (isset($_POST["id"])) {
    // CONNECT TO THE DATABASE
    $e = escape_string($_POST['e']);
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $id = $_POST['id'];
    $fn = escape_string($fn);
    $ln = escape_string($ln);
    $query = query("SELECT * FROM users_registered WHERE email = '$e' LIMIT 1");
    confirm($query);
    $already_registered_check = mysqli_num_rows($query);
    // FORM DATA ERROR HANDLING
    if ($e == "" || $fn == "" || $ln == "") {
        echo "The form submission is missing values.";
        exit();
    } else if($already_registered_check==1)
    {
        //user is trying to login using facebook
        echo "login_from_facebook";
        $_SESSION['fname'] = $fn;
        $_SESSION['lname'] = $ln;
        $_SESSION['email'] = $e;
        exit();
    }
    else{
        // END FORM DATA ERROR HANDLING
        // Begin Insertion of data into the database
        // Hash the password and apply your own mysterious unique salt

        // Add user info into the database table for the main site table
        $query = query("INSERT INTO users_registered (first_name,last_name,email,password,activated) VALUES('$fn','$ln','$e','$id','1')");
        confirm($query);
        $_SESSION['fname'] = $fn;
        $_SESSION['lname'] = $ln;
        $_SESSION['email'] = $e;
        echo "signup_success_from_facebook";
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/start.css">
    <link rel="stylesheet" href="css/preloader.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/myScript.js"></script>

    <script>
        function initialize() {
            var mapProp = {
                center: new google.maps.LatLng(12.926561, 77.671945),
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        //end of google map code

        //start of fb login code

        // initialize and setup facebook javascript sdk
        window.fbAsyncInit = function () {
            FB.init({
                appId: '205463876476422',
                xfbml: true,
                version: 'v2.5'
            });

            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    console.log(response.status);
                }
                else if (response.status === 'not_authorized') {
                    console.log(response.status);
                }
                else {
                    console.log(response.status);
                }
            })

        };
        //housekeeping stuff
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function loginFacebook()
        {
            FB.login(function(response){
                if (response.status === 'connected') {
                    document.getElementById('status').innerHTML = 'We are connected';
                    console.log(response.status);
                    getInfo();
                }
                else if (response.status === 'not_authorized') {
                    document.getElementById('status').innerHTML = 'We are not logged in';
                    console.log(response.status);
                }
                else {
                    document.getElementById('status').innerHTML = 'You are not logged into facebook';
                    console.log(response.status);
                }
            },{scope:'email,user_likes'});
        }

        function getInfo()
        {
            FB.api('/me','GET',{fields: 'first_name,last_name,name,email'},function(response){
                console.log(response)
                var firstName = response.first_name;
                var lastName = response.last_name;
                var email = response.email;
                var id = response.id;
                var ajax = ajaxObj("POST", "index.php");
                ajax.onreadystatechange = function () {
                    if (ajaxReturn(ajax) == true) {
                        if (ajax.responseText.trim() == "signup_success_from_facebook") {
                            console.log(ajax.responseText);
                            //user signed up via fb
                            window.location="start2.php";
                            console.log("signup ok");
                        }
                        else if(ajax.responseText.trim() == "login_from_facebook") {
                            console.log(ajax.responseText);
                            window.location="start2.php";
                            console.log("login ok");
                        }

                    }
                }
                ajax.send("fn=" + firstName + "&ln=" + lastName + "&e=" + email + "&id=" + id);
            })
        }
    </script>
</head>
<body class="demo loading">
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>


<!--    navbar code     -->

<div class="wrapper">
    <div class="flex-nav">
        <ul>
            <li><a href="#about" class="smoothScroll">What We Do</a></li>
            <li><a href="start2.html">Learn Something New</a></li>
            <li><a href="start2.html">Teach Something Cool</a></li>
            <li><a href="#locate" class="smoothScroll">Locate us</a></li>
            <li><a href="#contact" class="smoothScroll">Get in Touch</a></li>
            <?
            if(isset($_SESSION['email']))
                echo '<li><a href="logout.php">Logout</a></li>';
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
<div id="particles-js">
    <div class="row topBar">
        <div class=" layout_quotes">
            <h2>
                <div id="wss">
                    <em></em>
                </div>
            </h2>
            <script>wss_elem = document.getElementById("wss");
            wssSlide(); </script>
        </div>

    </div>
    <!--page content-->

    <div class="page-content-wrapper">

        <div class="row">
            <div class="col-lg-12 text">
                <br>MEETUTU<br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text2">

                ​
                The joy meeting an expert teacher, for the craving learner<br><br>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4 learner selected">I am a Learner</div>
            <div class="col-md-4 teacher">I am a Teacher</div>
            <div class="col-md-2"></div>
        </div>
        <br>

        <div id="loaded-content">
            <form class="flex-form">

                <input type="search" placeholder="Enter subjects to learn" class="search">
                <label for="" class="from-label">From</label>
                <input type="date" class="date" name="from">

                <label for="" class="from-label">To</label>
                <input type="date" name="to" class="date">

                <select name="" id="" class="guest">
                    <option value="1">Bangalore</option>
                    <option value="2">Delhi</option>
                    <option value="3">Kolkata</option>
                    <option value="4">Mumbai</option>
                    <option value="5">Pune</option>
                </select>

                <input type="submit" value="Search" class="submit">

            </form>

        </div>
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-2">
                <div class="signup-button" data-toggle="modal" data-target="#myModal"><a name="about">Sign Up</a></div>
            </div>
            <div class="col-sm-5"></div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-6 button-container">
                            <div class="icon-container">
                                <i class="fa fa-google-plus fa-4x google"></i>
                            </div>
                            <div class="button-text">Login With Google</div>
                    </div>
                    <div class="col-xs-3"></div>
                </div>
                <div class="row">
                    <div class="col-xs-5">
                        <hr/></div>
                    <div class="col-xs-2 or">OR</div>
                    <div class="col-xs-5">
                        <hr/></div>
                </div>
                <div class="row" >
                    <div class="col-xs-3"></div>
                    <div class="col-xs-6 button-container">
                        <div class="icon-container">
                            <i class="fa fa-facebook fa-4x facebook"></i>
                        </div>
                        <div class="button-text2" onclick="loginFacebook()">Login With Facebook</div>
                    </div>
                    <div class="col-xs-3"></div>
                </div>
                <div class="row">
                    <div class="col-xs-5">
                        <hr/></div>
                    <div class="col-xs-2 or">OR</div>
                    <div class="col-xs-5">
                        <hr/></div>
                </div>
                <div class="row" id="signup-body">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10">
                        <input type="text" class="input-modal" id="firstname" placeholder="ENTER FIRST NAME" onkeyup="restrict('firstname')">
                        <input type="text" class="input-modal" id="lastname" placeholder="ENTER LAST NAME" onkeyup="restrict('lastname')">
                        <input type="email" class="input-modal" id="email" placeholder="ENTER EMAIL" onkeyup="restrict('email')" onblur="checkEmail()">
                        <div id="emailstatus"></div>
                        <input type="password" class="input-modal" id="pass1" placeholder="ENTER PASSWORD">
                        <input type="password" class="input-modal" id="pass2" placeholder="CONFIRM PASSWORD">
                        <div id="status"></div>
                        <div class="register-button" id="register-button" onclick="signup()">Register</div>

                    </div>
                    <div class="col-xs-1"></div>
                </div>


            </div>

            <div class="modal-body" id="login-body">
                <div class="row">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10" >
                        <input type="email" class="input-modal" id="login-email" placeholder="ENTER EMAIL ID">
                        <input type="password" class="input-modal" id="login-password" placeholder="ENTER PASSWORD">
                    </div>
                    <div class="col-xs-1"></div>
                </div>
                <div id="login-status"></div>


            </div>
            <div class="modal-footer">
                <div class="row">

                    <div class="col-xs-5 login-caption">Already Registered?</div>

                    <div class="col-xs-3 login-button" id="login-button">Log In</div>
                    <div class="col-xs-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<div class="row">
    <div class="col-xs-3"></div>

    <div class="col-xs-6 header-card wow flipInX" data-wow-duration="0.7s" data-wow-delay="0.78s">Our Works</div>
    <div class="col-xs-3"></div>

</div>
<hr>
<br><br>
<div class="border-top wow fadeIn" data-wow-duration="0.7s" data-wow-delay="0.78s">

</div>
<div class="container-fluid">
    <div class="row information-section">
        <div class="col-md-4 information-heading wow slideInLeft" data-wow-duration="0.3s" data-wow-delay="0.4s"><a name="locate">WHAT WE DO</a></div>
        <div class="col-md-8 information wow slideInRight" data-wow-duration="0.3s" data-wow-delay="0.4s">
            <div id="owl-demo" class="owl-carousel owl-theme">

                <div class="item"><img src="http://placehold.it/850x230" alt="The Last of us"></div>
                <div class="item"><img src="http://placehold.it/850x230" alt="GTA V"></div>
                <div class="item"><img src="http://placehold.it/850x230" alt="Mirror Edge"></div>
            </div>
        </div>
    </div>
</div>

<div class="border-top wow fadeIn" data-wow-duration="0.7s" data-wow-delay="0.78s"></div>
<br>
<div class="row">
    <div class="col-xs-3"></div>

    <div class="col-xs-6 header-card wow flipInX" data-wow-duration="0.7s" data-wow-delay="0.78s">Locate Us</div>
    <div class="col-xs-3"></div>

</div>
<hr>
<br><br>
<div class="border-top wow fadeIn" data-wow-duration="0.7s" data-wow-delay="0.78s"></div>
<div class="row">
    <div class="col-xs-12">
        <div id="googleMap" style="width: inherit; height: 300px;"></div>
    </div>
</div>
<a name="contact"><div class="border-top wow fadeIn" data-wow-duration="0.7s" data-wow-delay="0.78s"></div></a>

<!--start of footer layout-->
<br>
<div class="row">
    <div class="col-xs-3"></div>

    <div class="col-xs-6 header-card wow flipInX" data-wow-duration="0.7s" data-wow-delay="0.78s">Get in Touch</div>
    <div class="col-xs-3"></div>

</div>
<hr>
<br><br>
<div class="border-top wow fadeIn" data-wow-duration="0.7s" data-wow-delay="0.78s"></div>
<div class="container-fluid">
    <div class="row sum-footer">

        <div class="col-sm-4 footer-column1">
            <br><br><br>
            A group of enthusiasts driven by<br>
            the passion for technology and desire to try new things
        </div>
        <div class="col-sm-4 footer-column2">
            <br><br>
            Designed By<br>
            <b>Shaunak Sen</b><br>
            ..and lots of <img src="img/heart13.png" height="20">&nbsp;<img src="img/heart13.png"
                                                                            height="20"><br><br>
        </div>
        <div class="col-sm-4 footer-column3">
            <br>
            <b>We would love to hear from you</b>
            <br>
            <input type="email" class="input" placeholder="ENTER YOUR EMAIL">
            <textarea class="message" rows="7" cols="45" placeholder="ENTER YOUR MESSAGE"></textarea>

            <div class="submit2" style="width: 150px; color: #000000">Submit</div>
            <br>
        </div>
    </div>

</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/particles.js"></script>
<script src="js/app.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script>

    window.addEventListener("load", function () {
        $('body').addClass('loaded');
        console.log('ok');
    });
    $(document).ready(function () {
        new WOW().init();

        $("#owl-demo").owlCarousel({

            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true

            // "singleItem:true" is a shortcut for:
            // items : 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false

        });

        $('owl-prev').css('display', 'none');

        $('.learner').on('click',function(e){
            e.preventDefault();
            var $load = $('#loaded-content');
            $load.hide();
            $load.load('fragments/learner.html',function()
            {
                $('.learner').addClass('selected');
                $('.teacher').removeClass('selected');
            }).fadeIn('slow');
        });

        $('.teacher').on('click',function(e){
            e.preventDefault();
            var $load = $('#loaded-content');
            $load.hide();
            $load.load('fragments/teacher.html',function()
            {
                $('.teacher').addClass('selected');
                $('.learner').removeClass('selected');
            }).fadeIn('slow');
        });

    });
    $('owl-prev').css('display', 'none')

    $('#login-button').on('click',function()
    {
        $('#login-body').slideDown(300);
        $('#signup-body').slideUp(300);
        $('#login-button').attr('id','new-button');
        document.getElementById('new-button').addEventListener('click',login);
    })

</script>
</body>
</html>
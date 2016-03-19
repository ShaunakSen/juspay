<?php
require_once("resources/config.php");
function redirect_to($url)
{
    header('Location: '.$url);
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
        <div class="col-xs-3"></div>
        <div class="col-xs-6 welcome-message">
            <? if(isset($_SESSION['email']))
                echo "Hi...{$_SESSION['fname']} {$_SESSION['lname']}";
            ?>
        </div>
        <div class="col-xs-3"></div>
    </div>

    <div class="row">
        <div class="col-xs-3"></div>

        <div class="col-xs-6 header-card">Meet Your Mentors!!</div>
        <div class="col-xs-3"></div>

    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3">
            <div class="card hoverable">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="http://placehold.it/350x150">
                </div>
                <div class="card-content">
                    <blockquote class="activator teacher">Shaunak Sen<i class="material-icons right"
                                                                        style="cursor: pointer">more_vert</i>

                        <p class="subjects">Teaches:

                        <div class="individual-subject">Javascript</div>
                        <div class="individual-subject">jQuery</div>
                        <div class="individual-subject">PHP</div>
                        <div class="individual-subject">AngularJS</div>
                        </p></blockquote>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Shaunak Sen<i
                            class="material-icons right">close</i></span>

                    <p>Location: 89 Dum Dum Park Kolkata 700055</p>

                    <p><i class="fa fa-phone "></i>&nbsp;8481900767</p>

                    <p><i class="fa fa-envelope "></i>&nbsp;shaunak1105@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card hoverable">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="http://placehold.it/350x150">
                </div>
                <div class="card-content">
                    <blockquote class="activator teacher">Bhagu Dutta<i class="material-icons right"
                                                                        style="cursor: pointer">more_vert</i>

                        <p class="subjects">Teaches:

                        <div class="individual-subject">Javascript</div>
                        <div class="individual-subject">jQuery</div>
                        <div class="individual-subject-back">PHP</div>
                        <div class="individual-subject">AngularJS</div>
                        </p></blockquote>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Shaunak Sen<i
                            class="material-icons right">close</i></span>

                    <p>Location: 89 Dum Dum Park Kolkata 700055</p>

                    <p><i class="fa fa-phone "></i>&nbsp;8481900767</p>

                    <p><i class="fa fa-envelope "></i>&nbsp;shaunak1105@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card hoverable">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="http://placehold.it/350x150">
                </div>
                <div class="card-content">
                    <blockquote class="activator teacher">Paddy Paddy<i class="material-icons right"
                                                                        style="cursor: pointer">more_vert</i>

                        <p class="subjects">Teaches:

                        <div class="individual-subject">Javascript</div>
                        <div class="individual-subject">jQuery</div>
                        <div class="individual-subject-back">PHP</div>
                        <div class="individual-subject-back">Networking</div>
                        </p></blockquote>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Shaunak Sen<i
                            class="material-icons right">close</i></span>

                    <p>Location: 89 Dum Dum Park Kolkata 700055</p>

                    <p><i class="fa fa-phone "></i>&nbsp;8481900767</p>

                    <p><i class="fa fa-envelope "></i>&nbsp;shaunak1105@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card hoverable">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="http://placehold.it/350x150">
                </div>
                <div class="card-content">
                    <blockquote class="activator teacher">Manisha Sen<i class="material-icons right"
                                                                        style="cursor: pointer">more_vert</i>

                        <p class="subjects">Teaches:

                        <div class="individual-subject">Javascript</div>
                        <div class="individual-subject">jQuery</div>
                        <div class="individual-subject-back">PHP</div>
                        <div class="individual-subject-back">MySQL</div>
                        </p></blockquote>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Shaunak Sen<i
                            class="material-icons right">close</i></span>

                    <p>Location: 89 Dum Dum Park Kolkata 700055</p>

                    <p><i class="fa fa-phone "></i>&nbsp;8481900767</p>

                    <p><i class="fa fa-envelope "></i>&nbsp;shaunak1105@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

<a name="search">
    <div class="border-top"></div>
</a>

<div class="container-fluid">
    <br>

    <div ng-app="myApp" ng-controller="customersCtrl">
        <div class="row">
            <div class="input-field col s4">
                <input id="names" type="text" class="validate" ng-model="searchNames">
                <label for="names">Name</label>
            </div>
            <div class="input-field col s4">
                <input id="city" type="text" class="validate" ng-model="searchCountries">
                <label for="city">City</label>
            </div>
            <div class="input-field col s4">
                <input id="subject" type="text" class="validate" ng-model="searchSubjects">
                <label for="subject">Subject</label>
            </div>
        </div>
        <br/>

        <div class="row">
            <div class="col-sm-4">

                <div ng-repeat="x in records | filter:searchNames | filter:all | orderBy:'Name' "
                     class="list-name hoverable">
                    {{x.Name}}
                </div>
            </div>
            <div class="col-sm-4">
                <div ng-repeat="x in records | filter:searchCountries | filter:all | orderBy:'Name'"
                     class="list-city hoverable">
                    {{x.City}}
                </div>
            </div>
            <div class="col-sm-4">
                <div ng-repeat="x in records | filter:searchSubjects | filter:all | orderBy:'Name'"
                     class="list-subject hoverable">{{x.Subject}}
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="input-field col s4">
                <input id="all" type="text" class="validate" ng-model="all">
                <label for="all">Search All</label>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <br>

        <div class="row">
            <div class="col-lg-12 info">
                <br>
                <a name="dates">
                    This is a simple search app using Angularjs.
                    <br></a>
                The data is fetched from an external server in JSON format.
                <br>
                The data URL: <code>https://api.myjson.com/bins/2w7m7</code>
                <br><br>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-xs-3"></div>

    <div class="col-xs-6 header-card">Select the days which you can commit to learning</div>
    <div class="col-xs-3"></div>

</div>
<hr>
<!--start of grid -->
<div class="row">
    <div class="col-lg-7">
        <div class="all">
            <div class="monday hoverable z-depth-1">
                <div class="monday_head">Monday</div>
            </div>
            <div class="tuesday hoverable z-depth-1">
                <div class="monday_head">Tuesday</div>
            </div>
            <div class="wednesday hoverable z-depth-1">
                <div class="monday_head">Wednesday</div>
            </div>
            <div class="thursday hoverable z-depth-1">
                <div class="monday_head">Thursday</div>
            </div>
            <div class="friday hoverable z-depth-1">
                <div class="monday_head">Friday</div>
            </div>
            <div class="saturday hoverable z-depth-1">
                <div class="monday_head">Saturday</div>
            </div>
            <div class="sunday hoverable z-depth-1">
                <div class="monday_head">Sunday</div>
            </div>


            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>

            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>

            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>

            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>

            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>

            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
            <div class="grid-div hoverable z-depth-1"></div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="form-container">
            <br>

            <div class="row">
                <div class="col-xs-1"></div>
                <div class="input-field col-xs-4">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name">First Name</label>
                </div>
                <div class="col-xs-2"></div>
                <div class="input-field col s4">
                    <input id="last_name" type="text" class="validate">
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
                <div class="input col-xs-9">
                    <textarea class="message" id="textarea-message" placeholder="ENTER YOUR MESSAGE"></textarea>
                </div>
                <div class="col-xs-2"></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script>
    var app = angular.module('myApp', []);
    app.controller('customersCtrl', function ($scope, $http) {
        $http.get("https://api.myjson.com/bins/2w7m7")
            .success(function (response) {
                $scope.records = response.records;
            });
    });
</script>


<script>
    window.addEventListener("load", function () {
        $('body').addClass('loaded');
        console.log('ok');
    });
    var d = new Date();
    var days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
    var class_array = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen", "twenty", "twentyone", "twentytwo", "twentythree", "twentyfour", "twentyfive", "twentysix", "twentyseven", "twentyeight", "twentynine", "thirty", "thirtyone"];
    var no_of_days = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var e = 1;
    var month = d.getMonth();


    var constructedString = month + 1 + "/1/2016";
    console.log(month);
    console.log(constructedString);
    var d = new Date(constructedString);
    console.log(days[d.getDay()]);
    var element = document.getElementsByClassName(days[d.getDay()]);//returns an array
    var first_div = element[0];
    console.log(first_div);
    var sibling = first_div.nextElementSibling;
    for (var i = 1; i <= 6; ++i)
         var sibling = sibling.nextElementSibling;
    console.log(sibling)
    // sibling contains cell with day 1 for that month
    $day1 = $(sibling);
    $day1.addClass('one');
    $day1.addClass('1');
    $day1.addClass('days');
    $day1.html('<span class="day_number">1</span>');
    $day1.attr('data', 1);
    for (var i = 2; i <= no_of_days[month - 1]; ++i) {
        $day1 = $day1.next();
        $day1.html('<span class="day_number">' + i + '</span>');
        $day1.addClass(class_array[i]);
        $day1.addClass(i.toString());
        $day1.addClass('days');
        $day1.attr('data', i);
    }
    $('.days').css('background-color', '#FBD6D6');

    $('.days').on('click', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            $(this).addClass('selected');
        }
        /*
         var days = document.getElementsByClassName('selected');
         var length = days.length;
         var last_selected_day = days[length-1];
         console.log(last_selected_day);
         var child = last_selected_day.firstChild;
         var required_date = child.innerHTML;
         console.log(required_date)
         push_into_array(required_date);
         */
        get_the_days();
    });

    /*
     function push_into_array(date){
     var dates_selected = [];
     var flag = 1;
     for(var i=1;i<dates_selected.length;++i)
     {
     if(dates_selected[i]==date) {
     flag = 0;
     break;
     }
     }
     if(flag==1)
     {
     dates_selected.push(date)
     }
     console.log(dates_selected);
     }

     */

    function get_the_days() {
        var dates_selected = [];
        var selectedClasses = document.getElementsByClassName('selected');
        for (var i = 0; i < selectedClasses.length; ++i) {
            var date = selectedClasses[i].firstChild.innerHTML;
            dates_selected.push(date);
        }
        var text = "I am free for learning on the following dates: ";
        var text2 = "";
        console.log(dates_selected);
        for (i = 0; i < dates_selected.length; ++i) {
            text2 = text2 + dates_selected[i] + " ";
        }
        console.log(text2)

        var text_area_text = text + text2;
        $('#textarea-message').val(text_area_text);
    }


</script>

</body>
</html>
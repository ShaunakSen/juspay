/**
 * Created by shaunak on 15/3/16.
 */
function restrict(elem) {
    var tf = _(elem);
    var rx = new RegExp;
    if (elem == "email") {
        rx = /[' "]/gi;
    } else if (elem == "username") {
        rx = /[^a-z0-9]/gi;
    }
    else if (elem == "firstname") {
        rx = /[^a-z]/gi;
    }
    else if (elem == "lastname") {
        rx = /[^a-z]/gi;
    }
    tf.value = tf.value.replace(rx, "");
}
function emptyElement(x) {
    _(x).innerHTML = "";
}


function checkEmail() {
    var e = _("email").value;
    if (e != "") {
        _("emailstatus").innerHTML = 'checking ...';
        var ajax = ajaxObj("POST", "start.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) == true) {
                _("emailstatus").innerHTML = ajax.responseText;
            }

        }
        ajax.send("emailcheck=" + e);
    }
}



function signup() {
    var fn = _("firstname").value;
    var ln = _("lastname").value;
    var e = _("email").value;
    var p1 = _("pass1").value;
    var p2 = _("pass2").value;
    var status = _("status").value;
    if (e == "" || p1 == "" || p2 == "" || fn == "" || ln == "") {
        _("status").innerHTML = "Please fill out all of the form data";
    }
    else if (p1 != p2) {
        _("status").innerHTML = "Your password fields do not match";
    }
    else {
        // all ok
        _("register-button").style.display = "none";
        _("status").innerHTML = "please wait";
        var ajax = ajaxObj("POST", "start.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) == true) {
                if (ajax.responseText != "signup_success") {
                    _("status").innerHTML = ajax.responseText;
                    _("register-button").style.display = "block";
                }
                else {
                    _("status").innerHTML = "Ok.. please check ur inbox for the link"
                }
            }
        }
        ajax.send("fn=" + fn + "&ln=" + ln + "&e=" + e + "&p=" + p1);
    }

}


function login() {
    var e = _("login-email").value;
    var p = _("login-password").value;
    if (e == "" || p == "") {
        _("login-status").innerHTML = "Plz fill out the form data";
    }
    else {
        _("new-button").style.display = "none";
        _("login-status").innerHTML = "plz wait...";
        var ajax = ajaxObj("POST", "login.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) == true) {
                console.log(ajax.responseText);


                if (ajax.responseText.trim() == "login_failed") {
                    _("login-status").innerHTML = "Login Unsuccessful.. Please try again";
                    _("new-button").style.display = "block";

                }
                else {

                    window.location = "profile.php";
                    console.log(ajax.responseText);
                }



            }
        }
        ajax.send("e=" + e + "&p=" + p);
    }
}
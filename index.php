<?php
include './db_connect.php';
session_start();
$session_expired = 360000;
session_set_cookie_params($session_expired);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>welcome</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    </head>
    <style>
        #top{
            margin: 0px;
            height: 112px;
            background: url("image/top.png");
        }
        #middle{

            height: 500px;
            width: 100%;
            background : url("image/b.png");
            background-size: initial;
            background-position-x: 80%;
            background-repeat: no-repeat;


        }
        #bottom{
            margin: 0px;
            height: 55px;
            background: url("image/top.png");
        }
        #logo{
            margin-top: 0px;
            float: left;
            margin-left: 100px;
            height: 100px;
            width: 130px;
            background: url("image/newlogo.png");
            background-size: cover;
        }
        #signin{
            color: wheat;
            float:right;
            margin-top: 23px;
            margin-right: 10px;
            height: 100px;
            width: 400px;

        }
        .c{
            color:#0033FF;
            margin-left: 30px;
        }


    </style>
    <script>
//        var str = "Is this all there is?";
//    var patt1 = /[h]/g; 
//    var result = str.match(patt1);
        function check(object) {
            var x = object.value;
            var id = object.id;
            if (id == "username") {
                if (x != null) {
                    var invalid_char = /[^a-z]/g;
                    var invalid_num = /[^0-9]/g;
                    var res1 = x.match(invalid_char);
                    var res2 = x.match(invalid_num);
                    if (res1 != null && res2 != null) {
                        return document.getElementById("lable2").innerHTML = "invalid Enter only character",
                                document.getElementById(id).value = "";
                    }
                }
            }
            if (id == "email") {
                if (x != null) {
                    var res1 = x.match(/\w{@}/g);
                    var res2 = x.match(/.com$/g);
                    if (res1 == null && res2 == null) {
                        return    document.getElementById("lable3").innerHTML = "invalid e_mail ",
                                document.getElementById(id).value = "";
                    }
                }
                return document.getElementById("lable3").innerHTML = "";
            }
            if (id == "password") {
                if (x != null) {
                    var invalid_char = /[^a-z]/g;
                    var invalid_num = /[^0-9]/g;
                    var res1 = x.match(invalid_char);
                    var res2 = x.match(invalid_num);
                    if (res != null && res2 != null) {
                        return document.getElementById("lable4").innerHTML = "invalid Enter only character",
                                document.getElementById(id).value = "";
                    }
                }
            }
            if (id == "confirmPassword") {
                if (x != null) {
                    if (x != document.getElementById("password").value) {
                        document.getElementById("lable5").innerHTML = "not matched password",
                                document.getElementById(id).value = "";
                    }
                }
            }
        }
        function empty_lable(object) {
            var x = object.value;
            var id = object.id;
            if (id == "username") {
                return document.getElementById("lable2").innerHTML = "";
            }
            if (id == "password") {
                return document.getElementById("lable4").innerHTML = "";
            }
            if (id == "confirmPassword") {

                return document.getElementById("lable5").innerHTML = "";
            }
            if (id == "username") {
                return
                document.getElementById("lable2").innerHTML = "";
            }
            if (id == "email") {
                return document.getElementById("lable3").innerHTML = "";
            }
            if (id == "password") {
                return document.getElementById("lable4").innerHTML
                        = "";
            }
            if (id == "confirmPassword") {
                return document.getElementById("lable5").innerHTML = "";
            }
        }

    </script>
    <body>
        <div id="top">
            <div id="logo"> </div>
            <div id="home" title="home"> </div>
            <div id="signin">
                <form method="POST">
                    username &nbsp; &nbsp; <input style="margin-bottom: 15px;border-radius: 5px; color: black;" name="usernameIN" id="usernameIN" type="text" placeholder="username"><br>            
                    password &nbsp; &nbsp <input style="margin-bottom: 15px;border-radius: 5px; color: black;" name="passwordIN" type="password" id="passwordIN" placeholder="password">
                    <button id="button" name="signin" class="btn btn-success" style=" float: right;">sign in</button>
                </form>
                <label id="lable1" style="width:250px; height: 30px;color: red; "></label>
            </div>

        </div>
        <div id="middle" class="c">
            <form method="POST">
                <h2> <p style="color: greenyellow; margin-left: 30px;">sign Up</p></h2><br>
                <input name="username" id="username" style="margin-left: 30px; margin-bottom: 15px;border-radius: 5px;" type="text" placeholder="username" onblur="check(this);
                       " onclick="empty_lable(this)">
                <label id="lable2"  style=" color: red;"></label>
                <br>
                <input name="email" id="email" style="margin-left: 30px;margin-bottom: 15px;border-radius: 5px;" type="text" placeholder="email" onblur="check(this);">
                <label id="lable3"  style=" color: red; "></label>
                <br>
                <input name="password" id="password" style="margin-left: 30px; margin-bottom: 15px;border-radius: 5px;" type="password" placeholder="create password" onblur="check(this);" onclick="empty_lable(this)">
                <label id="lable4" style="color: red; "></label>
                <br>
                <input name="confirmPassword" id="confirmPassword" style="margin-left: 30px; margin-bottom: 15px;border-radius: 5px;" type="password" placeholder="confirm password" onblur="check(this);" onclick="empty_lable(this)">
                <label id="lable5" style="color: red; "></label>
                <br>

                <h4 class="c">country</h4>
                <select name="country" id="country" style="margin-left: 30px; max-width: 150px;border-radius: 5px;">
                    <option value="TD"

                            >
                        Chad (Tchad)
                    </option>
                    <option value="CL"

                            >
                        Chile
                    </option>
                    <option value="EC"

                            >
                        Ecuador
                    </option>
                    <option value="EG"

                            selected

                            >
                        Egypt (‫مصر‬‎)
                    </option>
                    <option value="ET"

                            >
                        Ethiopia
                    </option>
                    <option value="FJ"

                            >
                        Fiji
                    </option>
                    <option value="FI"

                            >
                        Finland (Suomi)
                    </option>
                    <option value="FR"

                            >
                        France
                    </option>
                    <option value="MW"

                            >
                        Malawi
                    </option>
                    <option value="MY"

                            >
                        Malaysia
                    </option>
                    <option value="MV"

                            >
                        Maldives
                    </option>
                    <option value="ML"

                            >
                        Mali
                    </option>
                    <option value="MT"

                            >
                        Malta
                    </option>
                    <option value="MH"

                            >
                        Marshall Islands
                    </option>
                    <option value="MQ"

                            >
                        Martinique
                    </option>
                    <option value="NG"

                            >
                        Nigeria
                    </option>
                    <option value="NF"

                            >
                        Norfolk Island
                    </option>
                    <option value="SL"

                            >
                        Sierra Leone
                    </option>
                    <option value="SG"

                            >
                        Singapore
                    </option>
                </select>
                <br><br>
                <h4 class="c">birthday</h4>
                <select name="day"  id="day" title="Day" style="max-width:80px;margin-left: 30px;border-radius: 5px; ">
                    <option value="day" >Day</option>
                    <option value="01">1</option>
                    <option value="02">2</option>
                    <option value="03">3</option>
                    <option value="04">4</option>
                    <option value="05">5</option>
                    <option value="06">6</option>
                    <option value="07">7</option>
                    <option value="08">8</option>
                    <option value="09">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select name="month"  id="month" title="Month" style="max-width:80px;border-radius: 5px;">
                    <option value="Month" >Month</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <select name="year"  id="year" title="Year" style="max-width:80px;border-radius: 5px;">
                    <option value="Year" >Year</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1956">1956</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>                               
                </select>
                <br><br>
                <input type="radio" name="gender" value="male" style="margin-left: 30px;"> male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="gender" value="female" style="margin-left: 15px; "> female<br><br>
                <button id="signup" name="submit" class="btn btn-primary" style="margin-left: 30px;max-width: 100px; ">sign up</button>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                if ($_POST['username'] != null && $_POST['password'] != null && $_POST['confirmPassword'] != null && $_POST['gender'] != null && $_POST['country'] != null && $_POST['email'] != null) {
                    
                    $date = date("Y-m-d h:i:s");
                    $x = $_POST['username'];
                    $_SESSION['username'] = $x;
                    $birthday = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
                    $signup_quary = "insert into users (username,email,password,photo,country,birthday,gender,cover,role,signUP) values ('"
                            . $_POST['username'] . "' , '" . $_POST['email'] . "' , '" . $_POST['password'] .
                            "' ," . "'image/avatar.jpg'" . ",'" . $_POST['country'] . "','" . $birthday . "' , '" . $_POST['gender'] . " '," . " 'image/cover.jpg' ,'0','" . $date . "' );";
                    mysqli_query($db_conn, $signup_quary);
                    echo '<script> window.location.assign("home.php");</script>';
                }
            }
            if (isset($_POST['signin'])) {
                $x = $_POST['usernameIN'];
                $_SESSION['username'] = $x;
                $check_username = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['usernameIN']);
                $check_password = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['passwordIN']);
                $signin_quary = "select * from users where username = '".$check_username.
                        "' and password = '".$check_password." ' limit 1;";
                $login = mysqli_query($db_conn, $signin_quary);

                if (mysqli_fetch_array($login)) {
                    echo '<script> window.location.assign("home.php");</script>';
                } else {
                    echo '<script> alert("faild login :( try again");</script>';
                }
            }
            ?>

        </div>
        <div id="bottom"></div>

    </body>
</html>
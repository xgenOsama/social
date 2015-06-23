<?php
include './db_connect.php';
session_start();
?>
<html>
    <head>
        <title>setting</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <style>
        div.l:hover {
            background-color: #4D94B8;
        </style>
        <script>
            function show_node(e) {
                if (e == "username") {
                    document.getElementById("username_div").style.height = "100px";
                    document.getElementById("edit_username").style.display = "block";
                }
                if (e == "password") {
                    document.getElementById("password_div").style.height = "180px";
                    document.getElementById("edit_password").style.display = "block";
                }
                if (e == "work") {
                    document.getElementById("work_div").style.height = "100px";
                    document.getElementById("edit_work").style.display = "block";
                }
                if (e == "studied") {
                    document.getElementById("study_div").style.height = "100px";
                    document.getElementById("edit_study").style.display = "block";
                }
                if (e == "birthday") {
                    document.getElementById("birthday_div").style.height = "150px";
                    document.getElementById("edit_birthday").style.display = "block";
                }


            }
            function hide_usernameDiv() {
                document.getElementById("edit_username").style.display = "none";
                document.getElementById("username_div").style.height = "50px";
            }
            function hide_passwordDiv() {
                document.getElementById("edit_password").style.display = "none";
                document.getElementById("password_div").style.height = "50px";
            }
            function hide_workDiv() {
                document.getElementById("edit_work").style.display = "none";
                document.getElementById("work_div").style.height = "50px";
            }
            function hide_studyDiv() {
                document.getElementById("edit_study").style.display = "none";
                document.getElementById("study_div").style.height = "50px";
            }
            function hide_birthdayDiv() {
                document.getElementById("edit_birthday").style.display = "none";
                document.getElementById("birthday_div").style.height = "50px";
            }
        </script>
        <body>
          
                <?php
                $user = $_SESSION['username'];
                $get_info = "select * from users where username = '" . $user . " ' limit 1;";
                $l = mysqli_query($db_conn, $get_info);
                $info = mysqli_fetch_array($l);
                ?>
                <div id="nav" style="height:60px; width: 100%; background: black;">
                    <img src="image/newlogo.png" style="float: left; width:30px;height: 30px;margin-left: 50px; margin-top: 10px; " title="profile" onclick="window.location.assign('home.php');">
                    <img src="image/message.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 10px; " title="message">
                    <img src="image/notification.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 10px; " title="notification">
                    <input type="text" style=" margin-left:50px;margin-top: 15px;float: left;width: 280px; border-radius:10px;" placeholder="   find more friends" onkeyup="find_friend(this.value);">
<!--                                <ul id="find_friends" style="overflow-y:auto; width: 250px;margin-top: 10px; height: 200px;float: left; border-radius: 10px;"></ul>-->
                    <!-- Single button -->
                    <div class="btn-group" style="width: 30px; height: 30px;margin-right:150px;float: right;margin-top: 15px;">
                        <button name="setting" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            more<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" style="float: right;">
                            <li><a href="setting.php" >setting</a></li>
                            <li><a href="#" >help</a></li>
                            <li><a href="#">report a problem</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">connect us</a></li>
                        </ul>
                    </div>
                    <a href="index.php" style="float: right; margin-top: 20px;margin-right: 20px;">logout</a>
                    <a href="profile.php" style="margin-top: 20px; margin-right:15px;float: right;"><?php echo$_SESSION['username']; ?></a>
                    <img src="<?php echo'uploads/' . $info['photo']; ?>" style="width: 30px; height: 30px;margin-right:10px;float: right;margin-top: 15px;">
                    <a href="home.php" style=" margin-right:15px;margin-top: 20px;float: right;" >home</a>

                </div>
            <div class="well" style="width: 90%; height: 100% ;margin-left: 5%; margin-top: 2%;">
                <img src="<?php echo'uploads/' . $info['photo']; ?>" style="height: 280px; width: 200px; float: right; border-radius: 5px;">
                <div  class="l" id="username_div" style="margin-top: 5px; height: 50px; width: 50%; border-radius: 5px;">
                    <p style=" margin-left: 40px; float: left;">username</p>
                    <a href="#" id="username" onclick="show_node(this.id)" style="float: left ; margin-left: 260px; margin-top: 10px;">Edit?</a>
                    <div id="edit_username" style="margin-top: 10px; display: none;" >
                        <form method="POST" enctype="multipart/form-data">
                            <input name="new_username" type="text" style="margin-top: 5px; border-radius: 5px;margin-left: 35px;width: 250px;" placeholder="  Enter new username">
                            <input type="button" value="confirm" onclick="hide_usernameDiv();
                            <?php
                            if ($_POST['new_username'] != "") {
                                $new_username = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['new_username']);
                                $sql = "update users set username='" . $new_username . "' WHERE id='" . $_SESSION['user_id'] . "' LIMIT 1;";
                                $query = mysqli_query($db_conn, $sql);
                            }
                            ?>" style="border-radius: 20px;margin-left: 60px; margin-right: 30px;" class="btn btn-primary btn-sm">
                            <input type="button" id="cancel" value="cancel" onclick="hide_usernameDiv();" style="border-radius: 20px;" class="btn btn-sm">
                        </form>
                    </div>
                </div>
                <div id="password_div" class="l" style="margin-top: 5px; height: 50px; width: 50%;border-radius: 5px; ">
                    <p style=" margin-left: 40px; float: left;">password</p>
                    <a href="#" id="password" style="float: left ; margin-left: 260px; margin-top: 10px;" onclick="show_node(this.id)">Edit?</a>
                    <div id="edit_password" style="margin-top: 10px;display: none;" >
                        <form method="POST" enctype="multipart/form-data">
                            <input type="text" name ="old_password" placeholder="   enter your password"style="margin-top: 5px; border-radius: 5px;margin-bottom: 5px;width: 250px; margin-left: 35px;"><br>
                            <input type="text" name ="new_password" placeholder="   enter new password"style="margin-top: 5px; border-radius: 5px;margin-bottom: 5px;width: 250px; margin-left: 35px;"><br>
                            <input type="text" name ="confirm_new_password" placeholder="   confirm new password"style="margin-top: 5px; border-radius: 5px;margin-bottom: 5px;width: 250px; margin-left: 35px;">
                            <input type="button" value="confirm" onclick="hide_passwordDiv();
                            <?php
                            $entered_pass = $_POST['old_password'];
                            $get_user_iformation = "select * from users where id = '" . $_SESSION['user_id'] . " ';";
                            $li = mysqli_query($db_conn, $get_user_iformation);
                            $information = mysqli_fetch_array($li);
                            if ($information['password'] == $entered_pass) {
                                if ($_POST['new_password'] != "" && $_POST['new_password'] == $_POST['confirm_new_password']) {
                                    $new_password = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['new_username']);
                                    $sql = "update users set password='" . $new_password . "' WHERE id='" . $_SESSION['user_id'] . "' LIMIT 1;";
                                    $query = mysqli_query($db_conn, $sql);
                                }
                            }
                            ?>" style="border-radius: 20px;margin-left: 65px; margin-right: 30px;margin-top: 5px;" class="btn btn-primary btn-sm">
                            <input type="button" value="cancel" onclick="hide_passwordDiv();" style="margin-left: 10px; border-radius: 20px;margin-top: 5px;" class="btn btn-sm">
                        </form>
                    </div>
                </div>
                <div id="work_div" class="l" style="margin-top: 5px; height: 50px; width: 50%;border-radius: 5px;">
                    <p style=" margin-left: 40px; float: left;">work At</p>
                    <a href="#" id="work" style="float: left ; margin-left: 275px; margin-top: 10px;" onclick="show_node(this.id);">Edit?</a>
                    <div id="edit_work" style="margin-top: 10px; display: none;" >
                        <form method="POST" enctype="multipart/form-data">
                            <input name="work" type="text" style="margin-top: 5px; border-radius: 5px;margin-left: 35px;width: 250px;" placeholder="  you work at .... as ....">
                            <input type="button"  value="confirm" onclick="hide_workDiv();
                            <?php
                            if ($_POST['work'] != "") {
                                $new_work = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['new_username']);
                                $sql = "update users set work='" . $new_work . "' WHERE id='" . $_SESSION['user_id'] . "';";
                                $query = mysqli_query($db_conn, $sql);
                            }
                            ?>" style="border-radius: 20px;margin-left: 60px; margin-right: 30px;" class="btn btn-primary btn-sm">
                            <input type="button" value="cancel" onclick="hide_workDiv();" style="border-radius: 20px;" class="btn btn-sm">
                        </form>
                    </div>
                </div>
                <div id="study_div" class="l" style="margin-top: 5px; height: 50px; width: 50%;border-radius: 5px;">
                    <p style=" margin-left: 40px; float: left;">studied</p>
                    <a href="#" id="studied" style="float: left ; margin-left: 275px; margin-top: 10px; " onclick="show_node(this.id)">Edit?</a>
                    <div id="edit_study" style="margin-top: 10px; display: none;" >
                        <form method="POST" enctype="multipart/form-data">
                            <input name="study" type="text" style="margin-top: 5px; border-radius: 5px;margin-left: 35px;width: 250px;" placeholder="  whate are you studing">
                            <input type="button"  value="confirm" onclick="hide_studyDiv();
                            <?php
                            if ($_POST['study'] != "") {
                                $new_study = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['new_username']);
                                $sql = "update users set education_level='" . $new_study . "' WHERE id='" . $_SESSION['user_id'] . "';";
                                $query = mysqli_query($db_conn, $sql);
                            }
                            ?>" style="border-radius: 20px;margin-left: 60px; margin-right: 30px;" class="btn btn-primary btn-sm">
                            <input type="button" value="cancel" onclick="hide_studyDiv();" style="border-radius: 20px;" class="btn btn-sm">
                        </form>
                    </div>
                </div>
                <div id="birthday_div" class="l" style="margin-top: 5px; height: 50px; width: 50%;border-radius: 5px;">
                    <p style=" margin-left: 40px; float: left;">birthday</p>
                    <a href="#" id="birthday" style="float: left ; margin-left: 270px; margin-top: 10px;" onclick="show_node(this.id);">Edit?</a><br>
                    <div id="edit_birthday" style="margin-top: 10px; display: none;" >
                        <form method="POST" enctype="multipart/form-data">
                            <select name="day"  id="day" title="Day" style=" float: left;max-width:80px;margin-left: 35px;margin-top: 15px;border-radius: 5px; ">
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
                            <select name="month"  id="month" title="Month" style=" float: left;margin-left: 10px;margin-top: 15px;max-width:80px;border-radius: 5px;">
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
                            <select name="year"  id="year" title="Year" style="float: left;margin-left: 10px; margin-top: 15px;max-width:80px;border-radius: 5px;">
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
                            <input type="button"  value="confirm" onclick="hide_birthdayDiv();
                            <?php
                            $birthday = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
                            $new_study = preg_replace("/[^A-Z0-9._-]/i", "_", $_POST['new_username']);
                            $sql = "update users set birthday='" . $birthday . "' WHERE id='" . $_SESSION['user_id'] . "';";
                            $query = mysqli_query($db_conn, $sql);
                            ?>" style="border-radius: 20px;margin-left: 120px;margin-top: 12px; margin-right: 20px;" class="btn btn-primary btn-sm">
                            <input type="button" value="cancel" onclick="hide_birthdayDiv();" style="border-radius: 20px;margin-top: 12px;" class="btn btn-sm">
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>
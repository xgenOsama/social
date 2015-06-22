<?php
include './db_connect.php';
session_start();
?>
<html>
    <head>
        <title>profile</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <script>
        function request_status(e) {
            var id = "div" + e.id;
            var value = e.value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var elem = document.getElementById(id);
                    elem.parentNode.removeChild(elem);
                }
            };
            xmlhttp.open("GET", "friend_req.php?r=" + value + "&id=" + e.id, true);
            xmlhttp.send();
        }

        function get_friend_request() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("all_friend_req").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET", "get_friend_req.php", true);
            xmlhttp.send();
        }
        function find_friend(e) {
            if (e.length != 0) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("find_friends").innerHTML = xmlhttp.responseText;
                        document.getElementById("find_friends").style.background = "#B2D1E0";
                    }
                };
                xmlhttp.open("GET", "find_friends.php?f=" + e, true);
                xmlhttp.send();
            }
            else {
                document.getElementById("find_friends").style.background = "";
                document.getElementById("find_friends").innerHTML = "";
            }
        }
        function redirect(id) {
            window.location.assign("friend_profile.php?id=" + id);
        }
    </script>
    <style>
        #p{
            margin-top:15px;
            margin-left: 40px;
            color: wheat;
        }
        .m{
            margin: 15px;
            float: right; 
            color: #0033FF;
        }
        #cover{
            border-radius: 25px;
            padding-top: 100px;
            margin-top: 5px;
            margin-right: 30px;
            margin-left: 30px;
            width: 95%;
            height: 270px;
        }
        #profile_pic{
            border-radius: 20px;  
            margin-left: 30px;
            width: 200px;
            height: 210px;
        }
        #friends{
            float: right;
            border-radius: 20px;  
            margin-top: 40px;
            margin-right: 35px;
            width: 20%;
            height: 70%;
            overflow-y:auto;
        }
        #newPost{
            float: right;
            border-radius: 20px;  
            margin-top: 40px;
            margin-right: 35px;
            width: 50%;
            height: 100%;
        }
        #post{
            border-radius: 20px;  
            margin-top: 20px;
            width: 98%;
            height: 40%;
        }
    </style>
    <body onload="get_friend_request()" >
        <?php
        $user = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username='$user' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $info = mysqli_fetch_array($query);
        ?>
        <div id="nav" style="height:60px; width: 100%; background: black;">
            <img src="image/newlogo.png" style="float: left; width:30px;height: 30px;margin-left: 50px; margin-top: 10px; " title="profile" onclick="window.location.assign('home.php');">
            <img src="image/message.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 10px; " title="message">
            <img src="image/notification.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 10px; " title="notification">
            <input type="text" style=" margin-left:50px;margin-top: 15px;float: left;width: 280px; border-radius:10px;" placeholder="   find more friends" onkeyup="find_friend(this.value);">
            <ul id="find_friends" style="overflow-y:auto; width: 250px;margin-top: 10px; height: 200px;float: left; border-radius: 10px;"></ul>
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
            <a href="logout.php" style="float: right; margin-top: 20px;margin-right: 20px;">logout</a>
            <a href="profile.php" style="margin-top: 20px; margin-right:15px;float: right;"><?php echo$_SESSION['username']; ?></a>
            <img src="<?php echo 'uploads/'.$info['photo']; ?>" style="width: 30px; height: 30px;margin-right:10px;float: right;margin-top: 15px;">
            <a href="home.php" style=" margin-right:15px;margin-top: 20px;float: right;" >home</a>

        </div>
        <div id="cover" style=" background:url('<?php echo $info['cover'] ?>'); background-size: cover;">
            <div id="profile_pic" style=" background:url('<?php echo 'uploads/'.$info['photo'] ?>'); background-size: cover;"> </div>
            <button class="btn btn-info"style="margin-left: 30px;width: 200px ;border-radius: 20px; " data-toggle="modal" data-target=".bs-example-modal-sm">Upload photo</button>
                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content" style="height: 170px;width: 280px;">
                                    <p style="color: blue;margin-top: 20px; margin-left: 20px;">upload new photo :D</p>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="modal-footer">
                                            <input type="file" name="new_photo" accept="image/*" style="margin-left: 40px; margin-top: 15px;"><br>
                                            <button  class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button name="upload_photo" class="btn btn-primary">upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>         
        </div>
        <?php
        if (isset($_POST['upload_photo'])) {
            define("UPLOAD_DIR", "uploads/");
            if (!empty($_FILES['new_photo'])) {
                $myFile = $_FILES['new_photo'];

                if ($myFile["error"] !== UPLOAD_ERR_OK) {
                    echo "<p>An error occurred.</p>";
                    exit;
                }
                // ensure a safe filename
                $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
                // don't overwrite an existing file
                $i = 0;
                $parts = pathinfo($name);
                while (file_exists(UPLOAD_DIR . $name)) {
                    $i++;
                    $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                }
                // preserve file from temporary directory
                $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);

                if (!$success) {
                    echo "<p>Unable to save file.</p>";
                    exit;
                }
                $sql = "UPDATE users SET photo='$name' WHERE username='$user'";
                mysqli_query($db_conn,$sql);
                // set proper permissions on the new file
                chmod(UPLOAD_DIR . $name, 0644);
                echo '<script> window.location.assign("profile.php");</script>';
            }
            //           $new_profile_photo = "uploads/".$name;
            //            $add_friend = " UPDATE users  set photo='".$new_profile_photo."' where id='". $_SESSION['user_id']."';";
            //            $quary = mysqli_query($db_conn, $add_friend);
        }
        ?>

        <div id="friends" class="well">
            <?php
            $get_me_friend = "select recever_id from friends_req where sender_id = '" . $_SESSION['user_id'] . "' and req_status = 'accept'"
                    . " union select sender_id from friends_req where recever_id='" . $_SESSION['user_id'] . " ' and req_status = 'accept';";
//            echo "$get_me_friend";
            $get_friends_query = mysqli_query($db_conn, $get_me_friend);
            while ($get_friend = mysqli_fetch_array($get_friends_query)):
                $get_me_friend_info = "select * from users where id = '" . $get_friend['recever_id'] . "';";
                $friends_query = mysqli_query($db_conn, $get_me_friend_info);
                while ($piece_of_info = mysqli_fetch_array($friends_query)) :
                    $name_of_friend = $piece_of_info['username'];
                    $photo_of_friend = $piece_of_info['photo'];
                    $id_of_friend = $piece_of_info['id'];

                endwhile;
                ?>
                <div style="border-bottom: 1px; height: 60px ;">
                    <a href= "friend_profile.php?id=<?php echo$id_of_friend; ?> "style="margin-left: 20px;"> <?php echo $name_of_friend; ?></a>
                    <img src="<?php echo $photo_of_friend; ?>" style="height:50px;width: 50px;border-radius: 10px; float: right;">
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <div id="newPost">
            <div class="well" id="post">
                <h4><p>write here your new post :D</p></h4>
                <form method="POST" enctype="multipart/form-data">
                    <textarea name="newPost" style="width:90%; height:70%;  "></textarea><br>
                    <button name="submit" class="btn btn-primary" style="margin:10px; margin-right:60px; width: 100px;float: right; ">post</button>
                    <input name="upload" type="file" style=" margin-top: 15px; margin-right:10px; width: 90px;float: right; ">

                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $date = date("Y-m-d h:i:s");
                    define("UPLOAD_DI", "uploads/");
                    if (!empty($_FILES['upload'])) {
                        $myFile = $_FILES['upload'];
                        if ($myFile["error"] !== UPLOAD_ERR_OK) {
                            echo "<p>An error occurred.</p>";
                            exit;
                        }
                        // ensure a safe filename
                        $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
                        // don't overwrite an existing file
                        $i = 0;
                        $parts = pathinfo($name);
                        while (file_exists(UPLOAD_DI . $name)) {
                            $i++;
                            $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                        }
                        // preserve file from temporary directory
                        $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DI . $name);
                        if (!$success) {
                            echo "<p>Unable to save file.</p>";
                            exit;
                        }
                        // set proper permissions on the new file
                        chmod(UPLOAD_DI . $name, 0644);
                    }
                    $file_name = $name;
                    if (!empty($_POST['newPost']) && !empty($_FILES["upload"])) {
                        $add_post_quary = "insert into posts (post, upload, date,user_id)values (' " . $_POST['newPost'] . "','uploads/"
                                . $file_name . "','" . $date . "','" . $info['id'] . "');";
                        mysqli_query($db_conn, $add_post_quary);
                    } else if (empty($_POST['newPost']) && !empty($_FILES["upload"])) {
                        $add_post_quary = "insert into posts (upload, date,user_id)values ('uploads/ "
                                . $file_name . "','" . $date . "','" . $info['id'] . "');";
                        mysqli_query($db_conn, $add_post_quary);
                    } else if (!empty($_POST['newPost'])) {
                        echo '<script> alert("file empty");</script>';
//                        $add_post_quary = "insert into posts (post, date,user_id)values ('" . $_POST['newPost'] ."','"
//                                .$date."','".$info['id'] ."');";
//                        mysqli_query($db_conn, $add_post_quary);
                    }
                }
                ?>
            </div>
            <?php
            //get posts

            $user_id = $info['id'];
            $my_posts = "select * from posts where user_id = '" . $user_id . "';";
            $get_posts = mysqli_query($db_conn, $my_posts);
            while ($p = mysqli_fetch_array($get_posts)) :
                $d = $p['date'];
                $po = $p['post'];
                $u = $p['upload'];
                $id_post = $p['id'];
                ?> 
                <div class="well" id="post">
                    <label style="height:90%; width: 95%;margin-left: 10px;">
                        <img src="<?php echo $info['photo'] ?>" style="height:40px;width: 40px; float: left;">
                        <label style="float: left; margin-left: 20px;margin-top: 10px;"> <?php echo 'post at: ' . "$d"; ?></label><br>
                        <lable>
                            <p style=" float: left; margin-left: 10px;width: 60%; margin-top: 5%;"><?php echo"$po"; ?></p>
                            <img src="<?php echo $u ?>" style="height:180px;width: 160px; float: right;">
                        </lable>
                    </label>
                    <a href="#" style="color:blue; float: left; margin-left: 10px; " onclick="changeStyle(this)" id="<?php echo $id_post; ?>">like</a>
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <div class = "well" style = "border-radius: 20px; margin-top: 100px;margin-right: 30px; width: 20%; height: 30%; float: right;" >
            <label>
                username : <?php echo $info['username'] ?><br>
                borne in <?php echo $info['birthday'] ?><br>
                <?php
                if (!$info['work'] == NULL) {
                    echo'work : ' . $info['work'] . "<br>";
                }
                ?>
                <?php
                if (!$info['education_level'] == NULL) {
                    echo 'studied ' . $info['education_level'];
                }
                ?>
            </label>
        </div>
        <div style = "margin-left: 30px; height: 300px; width: 250px; float: left ; overflow-y:auto;" id="all_friend_req"></div>
    </body>

</html>
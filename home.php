<?php
include './db_connect.php';
session_start();
?>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <title>home</title>
    </head>
    <style>
        #post{
            border-radius: 20px;  
            margin-top: 20px;
            width: 98%;
            height: 40%;
        }
    </style>
    <script>
        function find_friend(e) {
            if (e.length != 0) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("find_friends").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "find_friends.php?f=" + e, true);
                xmlhttp.send();
            }
            else {
                document.getElementById("find_friends").innerHTML = "";
            }
        }
        function redirect(id) {
            window.location.assign("friend_profile.php?id=" + id);
        }

    </script>
    <body>
        <?php
        $user = $_SESSION['username'];
        $get_info = "select * from users where username = '" . $user . " ' limit 1;";
        $l = mysqli_query($db_conn, $get_info);
        $info = mysqli_fetch_array($l);
        $_SESSION['user_id'] = $info['id'];
        ?>
        <div id="nav" style="height:70px; width: 100%; background: black;">
            <img src="image/newlogo.png" style="margin-left: 20px;margin-top: 10px;height:40px; width: 40px;float: left;" title="home">
            <img src="image/message.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 15px; " title="message">
            <img src="image/notification.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 15px; " title="notification">
            <a href="index.php" style=" margin-top: 25px; margin-right:70px;float: right;">logout</a>
            <a href="profile.php" style="margin-top: 25px; margin-right:15px;float: right;"><?php echo $_SESSION['username']; ?></a>
            <img src="<?php echo'uploads/'.$info['photo']; ?>" style="width: 30px; height: 30px;margin-right:10px;float: right;margin-top: 20px;">
            <a href="home.php" style=" margin-right:15px;margin-top: 25px;float: right;" >home</a>
            <div id="find_friends" style="overflow-y:auto; width: 250px; height: 70px;margin-right:150px;float: right;border-radius: 10px;"></div>
            <input type="text" style=" margin-right:20px;margin-top: 20px;float: right;width: 330px; border-radius:10px;" placeholder="   search" onkeyup="find_friend(this.value);">

        </div>
        <div  id="show_friend" style="height:60%; width: 20%;margin-left: 3%; float: left; " >
            <h4 style="color: blue;">suggest friends :D </h4>
            <?php
            //get posts
            $suggest_friend = "select id ,username, photo from users where id != '" . $info['id'] . "' ORDER BY RAND() limit 6;";
            $get_suggest_friend = mysqli_query($db_conn, $suggest_friend);
            while ($g = mysqli_fetch_array($get_suggest_friend)) :
                $username = $g['username'];
                $photo = $g['photo'];
                $id = $g['id'];
                ?> 
                <div style=" height: 90px; width:150px;border-radius: 10px; float: left;margin-right: 30px;margin-bottom: 10px; overflow-y:auto;" id="<?php echo $id; ?>">
                    <a href="friend_profile.php?id=<?php echo$id; ?>" style=" float: right; margin-top: 30px; "><?php echo $username; ?></a>
                    <img src="<?php echo $photo ?>" style="height:80px;width: 80px;border-radius: 10px; float: left;">
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <div id="friends" style="float: right; border-radius: 20px; margin-top:60px; margin-right: 35px; width: 20%; height: 70%; overflow-y:auto; " class="well">
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
                    <a href= "friend_profile.php?id=<?php echo$id_of_friend; ?>" style="margin-left: 20px;"> <?php echo $name_of_friend; ?></a>
                    <img src="<?php echo $photo_of_friend; ?>" style="height:50px;width: 50px;border-radius: 10px; float: right;">
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <div id="content" style="margin-right: 3%; float: right; border-radius: 20px; margin-top: 4%; margin-right: 35px; width: 50%; height: 100%;">
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
                    define("UPLOAD_DIR", "uploads/");

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
                        // set proper permissions on the new file
                        chmod(UPLOAD_DIR . $name, 0644);
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
                    } else if (!empty($_POST['newPost']) && empty($_FILES["upload"])) {
                        $add_post_quary = "insert into posts (post, date,user_id)values (' " . $_POST['newPost'] . "','"
                                . $date . "','" . $info['id'] . "');";
                        mysqli_query($db_conn, $add_post_quary);
                    } else {
                        echo "<p>not posted :(</p>";
                    }
                }
                ?>
            </div>

            <?php
            //get posts
            $user_id = $info['id'];
            $my_posts = "select * from posts where user_id = '" . $user_id .
                    "' or( select sender_id from friends_req where sender_id= '" . $user_id . "' and req_status = 'accept')";
            $get_posts = mysqli_query($db_conn, $my_posts);
            while ($p = mysqli_fetch_array($get_posts)) :
                $y = "select photo,username from users where id =" . $p['user_id'];
                $z = mysqli_query($db_conn, $y);
                $x = mysqli_fetch_array($z);
                $d = $p['date'];
                $po = $p['post'];
                $u = $p['upload'];
                $photo_src = $x['photo'];
                $username_of_friend = $x['username'];
                ?> 
                <div class="well" style="border-radius: 20px; margin-top: 20px; width: 98%; height: 40%;overflow-y:auto;">
                    <div style="height:90%; width: 95%;margin-left: 10px; ">
                        <img src="<?php echo 'uploads/'.$photo_src ?>" style="height:40px;width: 40px; float: left;">
                        <a href="profile.php" style="margin-top: 7px; float: left; margin-right: 4px; margin-left: 4px;"><?php echo$username_of_friend ?></a>
                        <p style="float: left;margin-top: 7px;"> <?php echo 'post at: ' . "$d"; ?></p><br>
                        <div>
                            <p style=" float: left; margin-left: 10px;width: 60%; margin-top: 5%;"><?php echo"$po"; ?></p>
                            <img src="<?php echo $u ?>" style="height:180px;width: 160px; float: right;">
                        </div>
                    </div>
                    <a href="#" style="color:blue; float: left; margin-left: 10px; " onclick="changeStyle('l1')" id="<?php echo $id_post; ?>">like</a>
                </div>
                <?php
            endwhile;
            ?>
        </div>
    </body>
</html>
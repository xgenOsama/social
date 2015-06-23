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
        function request(value) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("send_request").value = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "friend_req.php?q=" + value, true);
            xmlhttp.send();
        }
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
        #follwer{
            float: right;
            border-radius: 20px;  
            margin-top: 40px;
            margin-right: 35px;
            width: 20%;
            height: 60%;
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
    <body>
        <?php
        $user = $_SESSION['username'];
        $get_info = "select * from users where username = '" . $user . " ' limit 1;";
        $l = mysqli_query($db_conn, $get_info);
        $info = mysqli_fetch_array($l);
        // get friend id
        $id_friend = $_GET['id'];
        $_SESSION['id_friend'] = $id_friend;
        //get friend information
        $get_friend_info = "select * from users where id = '" . $id_friend . " ' limit 1;";
        $l = mysqli_query($db_conn, $get_friend_info);
        $friend_info = mysqli_fetch_array($l);
        ?>
       <div id="nav" style="height:70px; width: 100%; background: black;">
            <img src="image/newlogo.png" style="margin-left: 20px;margin-top: 10px;height:40px; width: 40px;float: left;" title="home">
            <img src="image/message.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 15px; " title="message">
            <img src="image/notification.png" style="float: left; width:30px;height: 30px;margin-left: 20px; margin-top: 15px; " title="notification">
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
            <a href="logout.php" style=" margin-top: 25px; margin-right:30px;float: right;">logout</a>
            <a href="profile.php" style="margin-top: 25px; margin-right:15px;float: right;"><?php echo $_SESSION['username']; ?></a>
            <img src="<?php echo'uploads/'. $info['photo']; ?>" style="width: 30px; height: 30px;margin-right:10px;float: right;margin-top: 20px;">
            <a href="home.php" style=" margin-right:15px;margin-top: 25px;float: right;" >home</a>
            <input type="text" style=" margin-left:60px;margin-top: 20px;float: left;width: 330px; border-radius:10px;" placeholder="   search" onkeyup="find_friend(this.value);">
            <ul id="find_friends" style="overflow-y:auto; width: 250px;margin-top: 10px; height: 50px;float: left; border-radius: 10px;"></ul>
        </div>
        <div id="cover" style=" background:url('<?php echo $friend_info['cover'] ?>'); background-size: cover;">
            <?php $uploads='uploads/'?>
            <div id="profile_pic" style=" background:url('<?php echo $uploads.$friend_info['photo'] ?>'); background-size: cover;"> </div>
            <input id="send_request" class="btn btn-info" type="button" value="<?php
            //check relation
            $check_friend = "select * from friends_req where sender_id = '" . $_SESSION['user_id'] . "' and recever_id='" . $_SESSION['id_friend'] .
                    "' union select * from friends_req where sender_id = '" . $_SESSION['id_friend'] . "' and recever_id='" . $_SESSION['user_id'] . "' limit 1;";
            $li = mysqli_query($db_conn, $check_friend);
            if (mysqli_fetch_array($li) == TRUE) {
                $x = mysqli_fetch_array($li);
                if ($x['req_status'] == "sending") {
                    echo "friend request sent";
                } else {
                    echo "Unfriend";
                }
            } else {
                echo "Add friend";
            }
            ?>" style="margin-left: 30px;width: 200px ;border-radius: 20px; " onclick="request(this.value);"> 
        </div>
        <div id="follwer" class="well">
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
                    <img src="<?php echo 'uploads/'.$photo_of_friend; ?>" style="height:50px;width: 50px;border-radius: 10px; float: right;">
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <div id="newPost">

            <?php
            //get posts
            $my_posts = "select * from posts where user_id = '" . $id_friend . "';";
            $get_posts = mysqli_query($db_conn, $my_posts);
            while ($p = mysqli_fetch_array($get_posts)) :
                $d = $p['date'];
                $po = $p['post'];
                $u = $p['upload'];
                ?> 
                <div class="well" id="post">
                    <label style="height:90%; width: 95%;margin-left: 10px;">
                        <img src="<?php echo 'uploads/'.$friend_info['photo'] ?>" style="height:40px;width: 40px; float: left;">
                        <label style="float: left; margin-left: 20px;margin-top: 10px;"> <?php echo 'post at: ' . "$d"; ?></label><br>
                        <lable>
                            <p style=" float: left; margin-left: 10px;width: 60%; margin-top: 5%;"><?php echo"$po"; ?></p>
                            <img src="<?php echo 'uploads/'.$u ?>" style="height:180px;width: 160px; float: right;">
                        </lable>
                    </label>
                    <lable style="color:blue; float: left; margin-left: 10px; " onclick="changeStyle('l1')" id="l1">like</lable>
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <div class = "well" style = "border-radius: 20px; margin-top: 100px;margin-right: 30px; width: 20%; height: 30%; float: right;" >
            username : <?php echo $friend_info['username'] ?><br>
            borne in <?php echo $friend_info['birthday'] ?><br>
            <?php
            if (!$friend_info['work'] == NULL) {
                echo'work : ' . $friend_info['work'] . "<br>";
            }
            ?>
            <?php
            if (!$friend_info['education_level'] == NULL) {
                echo 'studied ' . $friend_info['education_level'];
            }
            ?>
        </div>
    </body>
</html>
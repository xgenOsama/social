<?php
include './db_connect.php';
session_start();
?>
<html>
    <head>
        <title>profile</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css"/>
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
    </script>
    <style>
        #home{
            float: left;
            margin-top: 15px;
            margin-left: 70px;
            height: 35px;
            width: 35px;
            background: url("image/newhome.png");
            background-size: cover;
        }
        #message{
            float: left;
            margin-top: 20px;
            margin-left: 20px;
            height: 30px;
            width: 30px;
            background: url("image/message.png");    
            background-size: cover;
        }
        #notifi{
            float: left;
            margin-top: 15px;
            margin-left: 20px;
            height: 40px;
            width: 40px;
            background: url("image/notification.png");
            background-size: cover;
        }
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
        // get friend id
        $id_friend = $_GET['id'];
        $_SESSION['id_friend'] = $id_friend;
        //get friend information
        $get_friend_info = "select * from users where id = '" . $id_friend . " ' limit 1;";
        $l = mysqli_query($db_conn, $get_friend_info);
        $friend_info = mysqli_fetch_array($l);
        ?>
        <div id="nav" style="height:60px; width: 100%; background: black;">
            <div id="home" title="home" onclick="window.location.assign('home.php');"></div>
            <div id="notifi" title="notifications"></div>
            <div id="message" title="message"></div>
            <div id="logout" class="m">
                <a href="index.php">logout</a>
            </div>
            <div id="more" class="m"> drop down</div>
            <div id="search" class="m">search</div>
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
                if ($x['req_status'] == "accept") {
                    echo "Unfriend";
                } else {
                    echo "friend request sent";
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
                            <img src="<?php echo $u ?>" style="height:180px;width: 160px; float: right;">
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
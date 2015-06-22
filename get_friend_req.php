<?php

session_start();
include_once './db_connect.php';
//check relation
$check_friend = " select sender_id from friends_req where recever_id ='" . $_SESSION['user_id'] . "' and req_status = 'sending';";
$li = mysqli_query($db_conn, $check_friend);
while ($friend_request = mysqli_fetch_array($li)) {
    $y = "select * from users where id =" . $friend_request['sender_id'];
    $z = mysqli_query($db_conn, $y);
    $x = mysqli_fetch_array($z);
    $friend_photo = $x['photo'];
    $friend_name = $x['username'];
    $friend_id = $x['id'];
    $output = "<div class = \"well\" style = \"border-radius: 15px; height: 115px; width:230px;  float: right;\" id=div" . $friend_id . " >
                            <div style=\"margin-top: 0px; height: 120px ;\">
                                <a href= \"friend_profile.php?id=" . $friend_id . "\" style=\"margin-left: 20px;\">" . $friend_name . "</a>
                                <img src=uploads\\". $friend_photo . " style=\"height:50px;width: 50px;border-radius: 10px; float: right;\"><br>
                                <input id=" . $friend_id . " onclick=\"request_status(this);\" type=\"button\" value=\"confirm\" class=\"btn btn-primary\" style=\" width: 120px ;border-radius: 15px;float: left; margin-top: 30px; margin-right:10px;\">
                                <input id=" . $friend_id . " onclick=\"request_status(this);\" type=\"button\" value=\"delete\" class=\"btn-danger\" style=\"width: 60px ;border-radius: 15px; float: left; margin-top: 5px;\">
                            </div>
                        </div>
                        <br>";
    echo "$output";
}
?>
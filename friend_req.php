<?php
session_start();
include_once './db_connect.php';
if (isset($_GET['q']) == "send_request") {
    #check relation
    $check_friend = "select * from friends_req where sender_id = '" . $_SESSION['user_id'] . "' and recever_id='" . $_SESSION['id_friend'] . " ' limit 1;";
    $li = mysqli_query($db_conn, $check_friend);
    $x = mysqli_fetch_array($li);
    if (!empty($x)) {
        if ($x['req_status'] == "accept" |$x['req_status'] == "sending" ) {
            $remove_friend = "DELETE FROM friends_req WHERE sender_id = '" . $_SESSION['user_id'] . "' and recever_id = ' " . $_SESSION['id_friend'] . "' ;";
            $remove_quary = mysqli_query($db_conn, $remove_friend);
            echo "Add friend";
        }
    } else {
            $add_friend = " insert into friends_req (sender_id,recever_id,date_req,req_status) values ('" . $_SESSION['user_id'] . "','" . $_SESSION['id_friend'] . "',now(),'sending');";
            $add_quary = mysqli_query($db_conn, $add_friend);
            echo "friend request sent";
    }
}
#confirm friend request
elseif (isset($_GET['r']) == "confirm") {
    $add_friend = " UPDATE friends_req  set req_status='accept' where sender_id='" . $_GET['id'] . "' and recever_id ='" . $_SESSION['user_id'] . "';";
    echo "$add_friend";
    $quary = mysqli_query($db_conn, $add_friend);
}
# delete friend request
elseif (isset($_GET['r']) == "delete") {
    $remove_friend = "DELETE FROM friends_req WHERE sender_id = '" . $_GET['id'] . "' and recever_id = ' " . $_SESSION['user_id'] . "' ;";
    echo "$remove_friend";
    $remove_quary = mysqli_query($db_conn, $remove_friend);
}
?>
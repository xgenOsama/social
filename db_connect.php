<?php
if(file_exists('/home/gen/')){
$db_user = 'g33k';
}else{
$db_user = 'nour';
}
$db_conn = mysqli_connect("localhost", "root",$db_user, "social");
if (mysqli_connect_errno()) {
    return mysqli_connect_error();
}
?>


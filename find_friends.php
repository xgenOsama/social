<style>
    li.l:hover {
    background-color: #80B2CC;
}
</style>
<?php
include './db_connect.php';
$get_info = "select * from users where username like '".$_GET['f']."%' ;";
$l = mysqli_query($db_conn, $get_info);
while ($info = mysqli_fetch_array($l)) {
    $id = $info['id'];
        $photo = "uploads/". $info['photo'];
    $username = $info['username'];
    $output = "<li class=\"l\" style=\"height:40px; width:200px;\"id=\"".$id."\" onclick=\"redirect(this.id);\">"
            ."<img src=".$photo." style=\"width:40px; height:35px; float:left;margin-bottom:2px;\">".
            "<p style=\"float:left;margin-left:70px; color: blue;margin-top:5px;\">".$username."</p>"
            . "</li>";
    echo "$output";
}
?>
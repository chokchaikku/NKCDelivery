<?php
$con = mysqli_connect("localhost","root","","nkcfooddelivery");
mysqli_set_charset($con,"utf8");

$member_id = $_GET["member_id"];

$query = "DELETE FROM member WHERE member_id='$member_id'";
mysqli_query($con,$query);

header("Location:admin_fix_member.php");
?>


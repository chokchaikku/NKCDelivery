<?php
$con = mysqli_connect("localhost","root","","nkcfooddelivery");
mysqli_set_charset($con,"utf8");



$username = $_GET["username"];
$psw = $_GET["psw"];
$fullname = $_GET["fullname"];
$email = $_GET["email"];
$tel = $_GET["tel"];
$customer_add = $_GET["customer_add"];



$query = "INSERT INTO `member` (`member_id`, `username`, `psw`, `fullname`,`email`, `tel`, `customer_add`, `status`) 
VALUES (NULL, '$username', '$psw', '$fullname','$email', '$tel', '$customer_add','0')";
if(mysqli_query($con,$query))
{
    echo '<script language="javascript" type="text/javascript"> 
                alert("สมัครชิกสำเร็จ");
                window.location = "index.php";
        </script>';
}


?>

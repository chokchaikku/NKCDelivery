<?php
$connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");

$aDeatail = $_POST['detail_id'];
$oOrder = $_POST['order_id'];
$member_id = $_POST['member_id'];


$i = 0;

foreach($aDeatail as $a){
    $order_insert = $oOrder[$i];


    $update1 = "UPDATE orders SET status=2 WHERE order_id=$order_insert";
    mysqli_query($connect,$update1);


    ++$i;
}
    header("Location:staff_page.php");
?>
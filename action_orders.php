<?php
$connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");

$aDeatail = $_POST['detail_id'];
$oOrder = $_POST['order_id'];
$member_id = $_POST['member_id'];


$i = 0;

foreach($aDeatail as $a){
    $order_insert = $oOrder[$i];


    $update1 = "UPDATE orders SET status=1 WHERE order_id=$order_insert";
    mysqli_query($connect,$update1);

    $update2 = "UPDATE orders SET m_id=$member_id WHERE order_id=$order_insert";
    mysqli_query($connect,$update2);

    $insert = "INSERT INTO receive VALUES(NULL,$order_insert,$a,$member_id)";
    mysqli_query($connect,$insert);

    ++$i;
}
    header("Location:staff_page.php");
?>
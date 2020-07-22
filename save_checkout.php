<?php
session_start();
$con = mysqli_connect("localhost","root","","nkcfooddelivery");
mysqli_set_charset($con,"utf8");

$name = $_POST["name"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$address = $_POST["address"];
$shipping = $_POST["shipping"];


/*

function pre_r($array){
    echo'<pre>';
    print_r($array);
    echo'</pre>';
}*/


$query = "INSERT INTO `orders` (`order_id`,`order_date`, `name`, `email`,`tel`, `address`,`total`) 
VALUES (NULL, NOW(),'$name','$email', '$tel', '$address','$shipping')";
mysqli_query($con,$query);

$last_id = mysqli_insert_id($con);

foreach($_SESSION['shopping_cart'] as $key => $sub_row):
 $food_id = $sub_row['food_id'];
 $res_id =  $sub_row['restaurant_id'];
 $qun =  $sub_row['quantity'];
 $price = $sub_row['price'];


 $query2 = "INSERT INTO `orders_detail` (`detail_id`, `order_id`, `food_id`, `restaurant_id`, `qty`, `total`) 
 VALUES (NULL, $last_id, $food_id, $res_id, $qun, $price)";
 if(mysqli_query($con,$query2))
 {
    echo '<script language="javascript" type="text/javascript"> 
                 alert("ทำการสั่งอาหารสำเร็จ กรุณารอพนักงานติดต่อกลับ");
                 window.location = "index.php";
         </script>';
 }

endforeach;
unset($_SESSION["shopping_cart"]);
?>










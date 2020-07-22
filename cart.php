<?php
// Start the session
session_start();
$product_ids = array();
//session_destroy();

if(filter_input(INPUT_POST,'add_to_cart')){
  if(isset($_SESSION['shopping_cart'])){

    $count = count($_SESSION['shopping_cart']);

    $product_ids = array_column($_SESSION['shopping_cart'],'food_id');
    
    if (!in_array(filter_input(INPUT_GET,'id'), $product_ids)){
    $_SESSION['shopping_cart'][$count] = array
      (
          'food_id' => filter_input(INPUT_GET,'food_id'),
          'restaurant_id' => filter_input(INPUT_GET,'restaurant_id'),
          'food_name' => filter_input(INPUT_POST,'food_name'),
          'price' => filter_input(INPUT_POST,'price'),
          'quantity' => filter_input(INPUT_POST,'quantity')
          
      );
    }
    else {
        for ($i = 0; $i < count($product_ids); $i++){
            if ($product_ids[$i]== filter_input(INPUT_GET,'food_id'))
                $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST,'quantity');
        }
    }

  }
  else {
      $_SESSION['shopping_cart'][0] = array
      (
          'food_id' => filter_input(INPUT_GET,'food_id'),
          'restaurant_id' => filter_input(INPUT_GET,'restaurant_id'),
          'food_name' => filter_input(INPUT_POST,'food_name'),
          'price' => filter_input(INPUT_POST,'price'),
          'quantity' => filter_input(INPUT_POST,'quantity')
          
      );
  }
}
if(isset($_POST['delete'])){
    if($_GET['action']=='delete'){
        foreach($_SESSION['shopping_cart'] as $key => $sub_row){
            if($sub_row['food_id']==$_GET['food_id'])
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

$id=$_SESSION["shopping_cart"][0]["restaurant_id"];
$db = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
  mysqli_set_charset($db,"utf8");
$Data="SELECT * FROM `restaurant` WHERE `restaurant_id`=$id";
$DataQuery=mysqli_query($db,$Data);
while ($row = mysqli_fetch_assoc($DataQuery)) {$restsurantCoust = $row["cost"];}


//pre_r($_SESSION);
function pre_r($array){
    echo'<pre>';
    print_r($array);
    echo'</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NKC Food Delivery</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
<style>

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 20%;
  border-radius: 5px;
  margin: 40px;
  display: inline-block;
  
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  
}

img {
  border-radius: 5px 5px 0 0;
}

.container {
  padding: 2px 16px;

}
.h4{
  text-align: center;
}
body { margin: 0px 0px; padding: 0px 0px}
a:link { color: #005CA2; text-decoration: none}
a:hover { color: #0099FF; text-decoration: none}

</style>
</head>
<body>
    <nav>
    <div class="logo">
    <a href="index.php"><img src="images/logo.png" alt="Avatar" class="avatar" width="110" heigth="110"></a>
    </div>
        <ul>
            <li><a href="index.php">หน้าแรก</a></li>
            
            <?php
        if (isset($_SESSION['member_id'])){
            if($_SESSION['status']==0){
                if(isset($_SESSION['shopping_cart'])){
                    $count = count($_SESSION['shopping_cart']);
                    echo "<li><a href='cart.php'>ตะกร้าสินค้า <span id='cart_count' class='badge badge-secondary badge-pill'>$count</span></a></li>";
                    echo "<li><a href='profile.php?member_id=" . $_SESSION["member_id"] ."'>".$_SESSION['fullname'];
                    echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
                  }else{
                    echo "<li><a href='cart.php'>ตะกร้าสินค้า <span id='cart_count'>0</span></a></li>";
                    
                  }
            }else{
                echo "<li><a href='profile.php'> ".$_SESSION['fullname'];
                echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
            }
            
        }
        else{
          echo "<li><a href='register_staff.php'>สมัครพนักงานส่งอาหาร</a></li>";
          echo "<li><a href='register_member.php'>สมัครสมาชิกทั่วไป</a></li>";
          echo "<li><a href='login.php'> เข้าสู่ระบบ</a></li>";
        }
        ?>
        </ul>
    </nav>
<br><br>
        <div class="container">
        <br/>
        <ul class="nav nav-tabs">
        </ul>
        <div class="tab-content">
        <br/>
        <div class="container-test">

          <div style="clear:both"></div>
          <br />
          <div class="table-reposive">
            <table class="table">
                <tr><th colspan="5"><h3>Order Details</h3></th></tr>
            <tr>
                <th width="40%">รายการ</th>
                <th width="10%">จำนวน</th>
                <th width="20%">ราคา</th>
                <th width="15%">ราคารวม</th>
                <th width="5%">Action</th>
            </tr>
            <?php
            if(!empty($_SESSION['shopping_cart'])):
                $total = 0;

                foreach($_SESSION['shopping_cart'] as $key => $sub_row):

            ?>
            
            <tr>
            <form method="post" action="cart.php?action=delete&food_id=<?php echo $sub_row['food_id']; ?>&restaurant_id=<?php echo $sub_row['restaurant_id']; ?>">
                <td><?php echo $sub_row['food_name']; ?></td>
                <td><?php echo $sub_row['quantity']; ?></td>
                <td>฿ <?php echo $sub_row['price']; ?></td>
                <td>฿ <?php echo number_format($sub_row['quantity'] * $sub_row['price'], 2); ?></td>
                <td>
                <input type="submit" name="delete" value="ลบรายการ"/>
                
                </td>
            </tr>
            </form>
            <?php

                    $total = $total + ($sub_row['quantity'] * $sub_row['price']);
                endforeach;
            ?>
            <tr>
                <td colspan="3" align="right">  ค่าส่ง <?php echo $restsurantCoust;  ?> Total</td>
                <td align="right">฿ <?php echo number_format($total+$restsurantCoust,2); ?></td>
                <td></td>
            </tr>
            <tr>

                <td colspan="5">
                <?php
                    if(isset($_SESSION['shopping_cart'])):
                    if(count($_SESSION['shopping_cart'])>0):
                     
                   
                ?>
                <a href="checkout.php?shipping=<?php echo $restsurantCoust;?>"><input type="submit" class="btn btn-success btn-lg btn-block" value="CheckOut"></a>
                    <?php endif; endif; ?>
                </td>
            </tr>
            <?php
            endif;
            ?>
            </table>
          </div>
        </div>
        </div>
        </body>
      </html>

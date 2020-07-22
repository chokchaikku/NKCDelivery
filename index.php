<?php
// Start the session
session_start();
$connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
$tab_query = "SELECT * FROM restaurant ORDER BY restaurant_id ASC";
$tab_result = mysqli_query($connect, $tab_query);
$tab_menu = '';
$tab_content = '';
$product_query = "SELECT * FROM restaurant";
$product_result = mysqli_query($connect, $product_query);
while($sub_row = mysqli_fetch_array($product_result))
{
  $tab_content .= '
  <div class="card">
  <a href="restaurant1.php?restaurant_id='.$sub_row["restaurant_id"].'"><img src="images/'.$sub_row["image"].'" alt="Avatar" style="width:100%;height:250px;">
  <div class="container">
  <h4 style="text-align:center"><b>'.$sub_row["restaurant_name"].'</b></h4>
  <hr>
  <p style="text-align:right">'.$sub_row["restaurant_detail"].'</p>
  </div>
</div></a>
  ';
}
$tab_content .= '<div style="clear:both"></div></div>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NKC Food Delivery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    echo "<li><a href='cart.php'>ตะกร้าสินค้า <span id='cart_count'>$count</span></a></li>";
                    echo "<li><a href='profile.php?member_id=" . $_SESSION["member_id"] ."'>".$_SESSION['fullname'];
                    echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
                  }else{
                    echo "<li><a href='cart.php'>ตะกร้าสินค้า <span id='cart_count'>0</span></a></li>";
                    echo "<li><a href='profile.php?member_id=" . $_SESSION["member_id"] ."'>".$_SESSION['fullname'];
                    echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
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
        <?php
        echo $tab_content;
        ?>
        </div>
        </div>
      </body>
      </html>

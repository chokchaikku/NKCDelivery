<?php
// Start the session
session_start();
$product_ids = array();
//session_destroy();
if(filter_input(INPUT_POST,'add_to_cart')){
  if(isset($_SESSION['shopping_cart'])){

    $count = count($_SESSION['shopping_cart']);

    $product_ids = array_column($_SESSION['shopping_cart'],'food_id');
    
    if (!in_array(filter_input(INPUT_GET,'food_id'), $product_ids)){
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
    <h1>CHECKOUT</h1>
    <div class="col-12">
        <div class="checkout">
            <div class="row">
           
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">รายการอาหาร</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $count ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                    <?php
                      if(!empty($_SESSION['shopping_cart'])):
                          $total = 0;
                          
                          foreach($_SESSION['shopping_cart'] as $key => $sub_row):
                          //echo $sub_row['']
                      ?>
                        
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $sub_row["food_name"]; ?></h6>
                                <small class="text-muted"><?php echo '฿'.$sub_row["price"]; ?> (<?php echo $sub_row["quantity"]; ?>)</small>
                            </div>
                            <?php

                            $total = $total + ($sub_row['quantity'] * $sub_row['price']);
                            endforeach;
                            ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>ค่าส่ง (บาท)</span>
                            <strong><?php echo number_format($_GET["shipping"],2); ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (บาท)</span>
                            <strong><?php echo number_format($total+$_GET["shipping"],2); ?></strong>
                        </li>
                    </ul>
                    <a href="index.php" class="btn btn-block btn-info">Add Items</a>
                    
                    <?php
            endif;
            ?>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Contact Details</h4>
                    <form method="POST" action="save_checkout.php">
                        
                            <div class="mb-3">
                                <label for="fullname">ชื่อ-นามสกุล</label>
                                <input type="hidden" name="shipping" value="<?php echo number_format($total+$_GET["shipping"],2); ?>">
                                <input type="text" class="form-control" name="name" value="<?php echo $_SESSION['fullname'] ?>" required>
                            </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone">เบอร์ติดต่อ</label>
                            <input type="number" class="form-control" name="tel" value="<?php echo $_SESSION['tel'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="textarea">ที่อยู่สำหรับจัดส่ง</label>
                            <input type="text" row="3" class="form-control" name="address" value="<?php echo $_SESSION['customer_add'] ?>" required>
                        </div>
                        <input type="hidden" />
                        <input class="btn btn-success btn-lg btn-block" type="submit"  value="Place Order">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
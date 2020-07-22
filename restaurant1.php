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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

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
        <div class="container-test">
        <?php
          
          $restaurant_id = $_GET['restaurant_id'];

          $connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
          $product_query = "SELECT * FROM food WHERE restaurant_id='$restaurant_id'";
         // $product_query  = "SELECT food.*,restaurant.* FROM food,restaurant WHERE restaurant_id='$restaurant_id'";				
          $result = mysqli_query($connect, $product_query);   
          $product_result = mysqli_query($connect, $product_query);

          if ($product_result):
            if (mysqli_num_rows($product_result)>0):
                while($sub_row = mysqli_fetch_array($product_result)):
        ?>

              <div class="card">
                <form method="post" action="restaurant1.php?action=add&food_id=<?php echo $sub_row['food_id']; ?>&restaurant_id=<?php echo $sub_row['restaurant_id']; ?>">
                  <img src="images/<?php echo $sub_row['image']; ?>"  alt="Avatar" style="width:100%;height:250px;">
                  <div class="container">
                  <h4 style="text-align:center"><b><?php echo $sub_row['food_name']; ?></b></h4>
                <hr>
            <p style="text-align:right"><?php echo $sub_row['price']; ?> บาท</p>
            <input type="hidden" name="food_name" value="<?php echo $sub_row['food_name']; ?>"/>
            <label for="quantity">ระบุจำนวน : </label>
            <input type="number"  name="quantity" class="form-control" value="1" min="1" max="99">
            <br>
            <input type="hidden" name="price" value="<?php echo $sub_row['price']; ?>"/>
            <br>
            <input type="submit" class="button button1" onclick="add()" name="add_to_cart" 
            value="Add to Cart"/>
            
            <br>
            </form>
            </div>
        </div>
          <?php
          endwhile;
        endif;
    endif;
          ?>
      <script>
      function add() {
        alert("ทำการเพิ่มลงตะกร้าแล้ว");
      }
      </script>
        </body>
      </html>

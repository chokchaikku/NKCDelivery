<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>NKC Food Delivery</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
  <nav>
    <div class="logo">
      <img src="images/logo.png" alt="Avatar" class="avatar" width="110" heigth="110">
    </div>
    <ul>
      <?php
        if (isset($_SESSION['member_id'])){
          echo "<li><a href='profile.php'> ".$_SESSION['fullname'];
          echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
        }
        else{
          echo "<li><a href='login.php'> เข้าสู่ระบบ</a></li>";
        }
        ?>
    </ul>
  </nav>


  <div class="w3-container">
    <h2>ยินดีตอนรับพนักงานส่งอาหาร : <?php echo $_SESSION['fullname'];?></h2>
    <br><br>

    <?php
          $order_id = $_GET['order_id'];

          $connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
          $product_query = "SELECT * FROM orders_detail AS A
           JOIN food AS B ON A.food_id=B.food_id
           JOIN restaurant AS C ON A.restaurant_id=C.restaurant_id
           WHERE order_id='$order_id'
          ";
          $res = mysqli_query($connect, $product_query);

        ?>

    <!-- Blog entries -->
    <div class="w3-col l8 s12">
      <!-- Blog entry -->
      <div class="w3-card-4 w3-margin w3-white " align="center">
        <div class="w3-container">
          <div>
            <form  action="action_orders.php" method="post">
              <?php
              $total = 0;
        while ($row = mysqli_fetch_assoc($res)){
            ?>
              <div class="w3-container">
                <h3><b>ออเดอร์ที่ : <?php echo $row['order_id']; ?></b></h3>
                <h4><b>หมายเลขออเดอร์ที่ : <?php echo $row['detail_id']; ?></b></h4>
              </div>
              <input type="hidden" name="order_id[]" value="<?php echo $row['order_id']; ?>">
              <input type="hidden" name="detail_id[]" value="<?php echo $row['detail_id']; ?>">
              <input type="hidden" name="member_id" value="<?php echo $_SESSION['member_id']; ?>">
              <label for="fname">เมนูอาหาร : </label>
              <input type="text" id="fname" name="firstname" value="<?php echo $row['food_name']; ?>" readonly>
              <br><br>
              <label for="lname">ร้านอาหาร</label>
              <input type="text" id="lname" name="lastname" value="<?php echo $row['restaurant_name']; ?>" readonly>
              <br><br>
              <label for="lname">จำนวน</label>
              <input type="text" id="lname" name="lastname" value="<?php echo $row['qty']; ?>" readonly>
              <br><br>
              <label for="lname">ราคา</label>
              <input type="text" id="lname" name="lastname" value="<?php echo $row['total']; ?>" readonly>
              <br><br>

              <?php 
              
            }    
              ?>
              <?php
              $connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
              $query1 ="SELECT * FROM `orders` WHERE `total`";
              $res1 = mysqli_query($connect, $query1);
              while ($row = mysqli_fetch_assoc($res1)){
                $total = $row["total"];
              }
              ?>
              <label for="">ราคารวม: <?php echo $total;?></label>
              <br><br>
              <input type="submit" class="w3-button w3-green" value="รับออเดอร์">
              <br><br>
            </form>
          </div>
        </div>
      </div>
      <hr>
</body>

</html>
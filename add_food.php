<?php
// Start the session
session_start();

    $con = mysqli_connect("localhost","root","","nkcfooddelivery");
    mysqli_set_charset($con,"utf8");
    $query = "SELECT * FROM restaurant";
    $res = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>welcome admin</title>
<link rel="stylesheet" href="style_register.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <style>
    table {
    width: 100%;
    
    }

    th, td {
    padding: 15px;
    text-align: left;
}
    </style>

</head>
<body>
      <nav>
        <div class="logo">
        <a href="admin_page.php"><img src="images/logo.png" alt="Avatar" class="avatar" width="110" heigth="110"></a>
        </div>
            <ul>

                <?php
            if (isset($_SESSION['member_id'])){
                if($_SESSION['status']==2){
                        echo "<li><a href='profile.php?member_id=" . $_SESSION["member_id"] ."'>".$_SESSION['fullname'];
                        echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
                    }else{
                        echo "<li><a href='profile.php?member_id=" . $_SESSION["member_id"] ."'>".$_SESSION['fullname'];
                        echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
                    }
                }else{
                    echo "<li><a href='profile.php'> ".$_SESSION['fullname'];
                    echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
                }
            
            ?>
            </ul>
      </nav>
<form action="action_add_food.php" method="POST" enctype="multipart/form-data">
<div class="wrapper">       
    <div class="title">
      เพิ่มเมนูอาหาร
    </div>
    <div class="form">
        <div class="inputfield">
            <label>เลือกร้านอาหาร</label>
            <select class="input" name="restaurant_id" required>
        <?php $connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");//conect db
        mysqli_set_charset($connect,"utf8");//set data utf8
        $product_query = "SELECT * FROM `restaurant`";//query
        $product_result = mysqli_query($connect, $product_query);
        //loop Dropdrow
        while($sub_row = mysqli_fetch_array($product_result)){?>
        <option value="<?php echo $sub_row["restaurant_id"];?>"><?php echo $sub_row["restaurant_name"];?></option>
        <?php } ?>
        </select>
       </div>

        <div class="inputfield">
          <label>ชื่อเมนู</label>
          <input type="text" class="input" name="food_name" required>
       </div>  
       <div class="inputfield">
          <label>ราคาอาหาร</label>
          <input type="number" class="input" name="price" required>
       </div> 
       <div class="inputfield">
          <label>รายละเอียด</label>
          <input type="text" class="input" name="food_detail" required>
       </div>  
  	<input type="hidden" name="size" value="1000000">
  	<div class="inputfield">
    <label>รูปอาหาร</label>
  	  <input type="file" name="image">
  	</div>
       <button type="submit" class="registerbtn" name="upload">เพิ่มเมนูอาหาร</button>
    </div>
    </div>
  </form>
</body>
</html>
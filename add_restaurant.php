<?php
// Start the session
session_start();
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
<form action="action_add_rest.php" method="POST" enctype="multipart/form-data">
<div class="wrapper">       
    <div class="title">
      เพิ่มร้านอาหาร
    </div>
    <div class="form"> 
        <div class="inputfield">
          <label>ชื่อร้าน</label>
          <input type="text" class="input" name="restaurant_name" required>
       </div>  
       <div class="inputfield">
          <label>รายละเอียดร้าน</label>
          <input type="text" class="input" name="restaurant_detail" required>
       </div>
       <div class="inputfield">
            <label>ราคาค่าส่ง</label>
            <input type="radio" id="cost" name="cost" value="10">
            <label for="cost"> 1-5 กิโลเมตร &nbsp;&nbsp;&nbsp;&nbsp; (10 บาท)</label><br>
            <input type="radio" id="cost" name="cost" value="15">
            <label for="cost"> 6-10 กิโลเมตร (15 บาท)</label><br>
            <input type="radio" id="cost" name="cost" value="20">
            <label for="cost"> 11-15 กิโลเมตร (20 บาท)</label>
       </div>  
  	<input type="hidden" name="size" value="1000000">
  	<div class="inputfield">
    <label>รูปร้านอาหาร</label>
  	  <input type="file" name="image">
  	</div>
       <button type="submit" class="registerbtn" name="upload">เพิ่มร้านอาหาร</button>
    </div>
    </div>
  </form>
</body>
</html>
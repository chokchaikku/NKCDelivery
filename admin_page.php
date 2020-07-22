<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>welcome admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link rel="stylesheet" href="style_register.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">

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
    <div class="wrapper">       
        <div class="title">
        ยินดีตอนรับ ADMIN
        </div>
        <div class="form"> 
        <button onclick="window.location.href = 'admin_fix_member.php';" type="submit" class="registerbtn" >จัดการข้อมูลสมาชิกทั่วไป</button>
        </div>
        <div class="form"> 
        <button onclick="window.location.href = 'admin_fix_staff.php';" type="submit" class="registerbtn" >จัดการข้อมูลพนักงานส่งอาหาร</button>
        </div>
        <div class="form"> 
        <button onclick="window.location.href = 'add_restaurant.php';" type="submit" class="registerbtn">+ เพิ่มร้านอาหาร</button>
        </div>
        <div class="form" > 
        <button onclick="window.location.href = 'add_food.php';" type="submit" class="registerbtn">+ เมนูอาหาร</button>
        </div>
    </div>
  </form>

    
</body>
</html>
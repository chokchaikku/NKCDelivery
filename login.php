<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style_login.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Sniglet&display=swap" rel="stylesheet">
    <title>เข้าสู่ระบบ</title>
</head>
<body>
    <nav>
        <div class="logo">
        <a href="index.php"><img src="images/logo.png" alt="Avatar" class="avatar" width="110" heigth="110"></a>
    </div>
        <ul>
            <li><a href="index.php">หน้าแรก</a></li>
            <li><a href="register_staff.php">สมัครพนักงานส่งอาหาร</a></li>
        <?php
        if (isset($_SESSION['member_id'])){
          echo "<li><a href='profile.php'> ".$_SESSION['fullname'];
          echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
        }
        else{
          echo "<li><a href='register_member.php'>สมัครสมาชิกทั่วไป</a></li>";
          echo "<li><a href='login.php'> เข้าสู่ระบบ</a></li>";
        }
        ?>
        </ul>
    </nav>
    <div class="signup-form">
        <img src="images/logo.png">
        <form action="action_login.php" method="post">
            <input type="text" placeholder="กรอกชื่อผู้ใช้" class="txt" name="username" >
            <input type="password" placeholder="กรอกรหัสผ่าน" class="txt" name="psw" >
            <input type="submit" value=" Login " class="btn" name="btn-login" >
        </form>
    </div>
    
</body>
</html>
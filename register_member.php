<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<head>
    <title>สมัครพนักงานส่งอาหาร</title>
    <link rel="stylesheet" href="style_register.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
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
<form action="action_register_member.php" method="GET">
<div class="wrapper">       
    <div class="title">
      สมัครสมาชิกทั่วไป
    </div>
    <div class="form"> 
        <div class="inputfield">
          <label>UserName <font color="red">*</font></label>
          <input type="text" class="input" name="username" required>
       </div>  
       <div class="inputfield">
          <label>Password <font color="red">*</font></label>
          <input type="password" class="input" name="psw" required>
       </div>  
      <div class="inputfield">
          <label>Confirm Password <font color="red">*</font></label>
          <input type="password" class="input" name="psw_repeat" required>
       </div>
       <div class="inputfield">
          <label>ชื่อ - นามสกุล <font color="red">*</font></label>
          <input type="text" class="input" name="fullname" required>
       </div> 
        <div class="inputfield">
          <label>Email Address <font color="red">*</font></label>
          <input type="email" class="input" name="email" required>
       </div> 
      <div class="inputfield">
          <label>เบอร์โทรติดต่อ <font color="red">*</font></label>
          <input type="number" class="input"  name="tel" required>
       </div> 
      <div class="inputfield">
          <label>ที่อยู่ <font color="red">*</font></label>
          <input type="text" class="input" name="customer_add" required>
       </div>
      <div class="inputfield terms">
          <label class="check">
            <input type="checkbox">
            <span class="checkmark"></span>
          </label>
          <p>ฉันยอมรับ เงื่อนไขการใช้การบริการ และ นโยบายความเป็นส่วนตัว</p>
       </div> 
       <button type="submit" class="registerbtn">ลงทะเบียน</button>
      <div class="container signin">
    <p>มีบัญชีอยู่แล้ว? <a href="form_login.php">เข้าสู่ระบบ</a></p>
  </div>
    </div>
    </div>
  </form>
</body>
</html>
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>แก้ไขข้อมูล</title>
    <link rel="stylesheet" href="style_register.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        <img src="images/logo.png" alt="Avatar" class="avatar" width="110" heigth="110">
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
        <br><br>
<?php
$con = mysqli_connect("localhost", "root","","nkcfooddelivery");
mysqli_set_charset($con, "utf8");

$member_id = $_GET["member_id"];
$query = "SELECT * FROM member WHERE member_id='$member_id'";
$res = mysqli_query($con,$query);
while ($row = mysqli_fetch_array($res)){
    ?>
   
    <form action="./update_member.php" method="get">
    <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">username</label>
    <input type="text" class="form-control"  name="username" value="<?php echo $row["username"]?>"><br>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="text" class="form-control"  name="psw" value="<?php echo $row["psw"]?>"><br>
  </div>
  <div class="form-group">
    <label for="exampleInputFullname">ชื่อ - นามสกุล</label>
    <input type="text" class="form-control"  name="fullname" value="<?php echo $row["fullname"]?>"><br>
  </div>
  <div class="form-group">
    <label for="exampleInputFullname">E-mail</label>
    <input type="text" class="form-control"  name="email" value="<?php echo $row["email"]?>"><br>
  </div>
  <button type="submit" class="btn btn-primary">บันทึก</button>
</form>
<?php
}
?>
</body>
</html>

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
    table{
      border-spacing: 0;
      border-collapse: collapse;
      margin-left: 350px;
    }
    #table{
      /*border: 1px solid red;*/
    }
    #table thead{
      background: #555555;
      border: 1px solid #555;
      
    }
    #table th{
      background: #555555;
      color: #fff;
      padding: 10px 4px;
      text-align: center;
    }
    #table td{
      border: 1px solid #D4D4D4;
      padding: 10px 0;
      text-align: center;
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
        <br><br>
            <div class="name_restu">
            <h3 style="text-align:center">พนักงานส่งอาหาร</h3>
            </div>
            <br><br>
    <table id="table">
    <thead>
        <tr>
            <th width="150">ลำดับ</th>
            <th width="300">ภาพประจำตัว</th>
            <th width="200">ชื่อ - นามสกุล</th>
            <th width="200">E - mail</th>
            <th width="150">เบอร์โทรศัพท์</th>
            <th width="150">เลขบัตรประชาชน</th>
            <th width="100">สถานะ</th>
            <th width="50">แก้ไข</th>
            <th width="50">ลบ</th>
        </tr>
    </thead>
    <?php
    $con = mysqli_connect("localhost","root","","nkcfooddelivery");
    mysqli_set_charset($con,"utf8");
    $query = "SELECT * FROM member WHERE status='1';";
    $res = mysqli_query($con, $query);
    $sr = 1;
    while ($row = mysqli_fetch_array($res)){
        ?>
        <tbody>
            <tr>
                <td><?php echo $sr;?></td>
                <td><?php echo'<img src="member/'.$row["image"].'" alt="Avatar" style="width:100%;height:250px;"'?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['tel']; ?></td>
                <td><?php echo $row['card_id']; ?></td>
                <td>เป็นพนักงาน</td>';
                <td><a href="./edit_staff.php?member_id=<?php echo $row['member_id']; ?>">แก้ไข</a></td>
                <td><a href="./del_staff.php?member_id=<?php echo $row['member_id']; ?>">ลบ</a></td>
            </form>
            </tr>
        </tbody>
            <?php $sr++;}
        ?>
        </table>
    
</body>
</html>
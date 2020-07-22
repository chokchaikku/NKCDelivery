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
      margin-left: 400px;
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
            <h3 style="text-align:center">สมาชิกทั่วไป</h3>
            </div>
            <br><br>
    <table id="table">
    <thead>
        <tr>
            <th width="150">ลำดับ</th>
            <th width="250">ชื่อ - นามสกุล</th>
            <th width="300">E - mail</th>
            <th width="120">เบอร์โทรศัพท์</th>
            <th width="300">ที่อยู่</th>
            <th width="50">แก้ไข</th>
            <th width="50">ลบ</th>
        </tr>
    </thead>
    <?php
    $con = mysqli_connect("localhost","root","","nkcfooddelivery");
    mysqli_set_charset($con,"utf8");
    $sr = 1;
    $query = "SELECT * FROM member WHERE status='0';";
    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($res)){
        ?>
        <tbody>
            <tr>
                <td><?php echo $sr;?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['tel']; ?></td>
                <td><?php echo $row['customer_add']; ?></td>
                <td><a href="edit_member.php?member_id=<?php echo $row['member_id']; ?>">แก้ไข</a></td>
                <td><a href="del_member.php?member_id=<?php echo $row['member_id']; ?>">ลบ</a></td>
            </tr>
        </tbody>
            <?php $sr++;}    
        ?>
        </table>

    
</body>
</html>
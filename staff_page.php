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

  <style>
    table{
      border-spacing: 0;
      border-collapse: collapse;
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
        <img src="images/logo.png" alt="Avatar" class="avatar" width="110" heigth="110">
        </div>
            <ul>

                <?php
            if (isset($_SESSION['member_id'])){
                if($_SESSION['status']==1){
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

    <div class="w3-container">
  <h2>ยินดีต้อนรับพนักงานส่งอาหาร : <?php echo $_SESSION['fullname'];?></h2>
  <br><br>

  <div class="w4-row">
    <a href="javascript:void(0)" onclick="openCity(event, 'London');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h4>กำลังรอการตอบรับ</h4></div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Paris');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h4>กำลังดำเนินการ</h4></div>
    </a>
    <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo');">
      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h4>สำเร็จแล้ว</h4></div>
    </a>
  </div>
  
  <div id="London" class="w3-container city" style="display:none">
  <?php
    $con = mysqli_connect("localhost","root","","nkcfooddelivery");   //show
    mysqli_set_charset($con,"utf8");
    $query_order = "SELECT * FROM orders WHERE status='0'";
    $res = mysqli_query($con, $query_order);

    ?>
            <br><br>
    <table id="table">
      <thead>
          <tr>
              <th width="50">#</th>
              <th width="150">หมายเลขออเดอร์</th>
              <th width="150">วันที่สั่งซื้อ</th>
              <th width="150">ชื่อ</th>
              <th width="150">เบอร์ติดต่อ</th>
              <th width="150">สถานะ</th>
              <th width="100">จัดการออเดอร์</th>
          </tr>
      </thead>
    <?php
    $sr = 1;
    while ($row = mysqli_fetch_array($res)){
        ?>
          <tbody>
            <tr>
                <td>{<?php echo $sr;?>}</td>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['order_date']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['tel']; ?></td>
                <td><h4>รอยืนยันออเดอร์</h4></td>   
                <td><a href="staff_view_orders.php?order_id=<?php echo $row['order_id']; ?>">ดูรายละเอียด</a></td>
            </tr>
          </tbody>
            <?php $sr++;}    
        ?>
        </table>
  </div>

  <div id="Paris" class="w3-container city" style="display:none">
  <?php
    $m_id = $_SESSION['member_id'];     //process
    $con = mysqli_connect("localhost","root","","nkcfooddelivery");
    mysqli_set_charset($con,"utf8");
    $query_order1 = "SELECT * FROM orders WHERE status='1' AND m_id='$m_id'";
    $res1 = mysqli_query($con, $query_order1);

    ?>
            <br><br>
    <table id="table">
      <thead>
          <tr>
              <th width="50">#</th>
              <th width="150">หมายเลขออเดอร์</th>
              <th width="150">วันที่สั่งซื้อ</th>
              <th width="150">ชื่อ</th>
              <th width="150">เบอร์ติดต่อ</th>
              <th width="150">สถานะ</th>
              <th width="100">จัดการออเดอร์</th>
          </tr>
      </thead>
    <?php
    $sr = 1;
    while ($row1 = mysqli_fetch_array($res1)){
        ?>
          <tbody>
            <tr>
                <td>{<?php echo $sr;?>}</td>
                <td><?php echo $row1['order_id']; ?></td>
                <td><?php echo $row1['order_date']; ?></td>
                <td><?php echo $row1['name']; ?></td>
                <td><?php echo $row1['tel']; ?></td>
                <td><h4>กำลังดำเนินการ</h4></td>   
                <td><a href="staff_view_process.php?order_id=<?php echo $row1['order_id']; ?>">ดูรายละเอียด</a></td>
            </tr>
          </tbody>
            <?php $sr++;}    
        ?>
        </table>
  </div>

  <div id="Tokyo" class="w3-container city" style="display:none"> 
  <?php
    $m_id = $_SESSION['member_id']; //สำเร็จ
    $con = mysqli_connect("localhost","root","","nkcfooddelivery");
    mysqli_set_charset($con,"utf8");
    $query_order2 = "SELECT * FROM orders WHERE status='2' AND m_id='$m_id'";
    $res2 = mysqli_query($con, $query_order2);

    ?>
            <br><br>
    <table id="table">
      <thead>
          <tr>
              <th width="50">#</th>
              <th width="150">หมายเลขออเดอร์</th>
              <th width="150">วันที่สั่งซื้อ</th>
              <th width="150">ชื่อ</th>
              <th width="150">เบอร์ติดต่อ</th>
              <th width="150">สถานะ</th>
              <th width="100">จัดการออเดอร์</th>
          </tr>
      </thead>
    <?php
    $sr = 1;
    while ($row2 = mysqli_fetch_array($res2)){
        ?>
          <tbody>
            <tr>
                <td>{<?php echo $sr;?>}</td>
                <td><?php echo $row2['order_id']; ?></td>
                <td><?php echo $row2['order_date']; ?></td>
                <td><?php echo $row2['name']; ?></td>
                <td><?php echo $row2['tel']; ?></td>
                <td><h4>ดำเนินการสำเร็จ</h4></td>   
                <td><a href="staff_view_suscess.php?order_id=<?php echo $row2['order_id']; ?>">ดูรายละเอียด</a></td>
            </tr>
          </tbody>
            <?php $sr++;}  
        ?>
        </table>
  </div>
</div>


<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script> 
</body>
</html>

<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NKC Food Delivery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 20%;
  border-radius: 5px;
  margin: 40px;
  display: inline-block;
  
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  
}

img {
  border-radius: 5px 5px 0 0;
}

.container {
  padding: 2px 16px;

}
.h4{
  text-align: center;
}
body { margin: 0px 0px; padding: 0px 0px}
a:link { color: #005CA2; text-decoration: none}
a:hover { color: #0099FF; text-decoration: none}

</style>
</head>
<body>
<nav>
    <div class="logo">
    <img src="images/logo.png" alt="Avatar" class="avatar" width="110" heigth="110">
    </div>
        <ul>
            <li><a href="index.php">หน้าแรก</a></li>
        <?php
        if (isset($_SESSION['member_id'])){
          echo "<li><a href='#'>ตะกร้าสินค้า</a></li>";
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
    <section class="restu1">
            <div class="manu">
                <div class="name_restu">
                <h3 style="text-align:center">ร้านโต๊ะแดง</h3>
                </div>
            </div>
    </section>

    <section class="restu2">
            <div class="card">
                    <img src="images/detailfood1.jpg" alt="Avatar" style="width:100%;height:250px;">
                        <div class="container">
                        <h4><b>ผัดกะเพรา</b></h4>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">เลือก</button>
                    <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">
            
                      <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"></button>
                              <img src="images/detailfood1.jpg" style="width:100%;">
                              <h4 class="modal-title" style="text-align:center">กะเพรารวม</h4>
                              
                            </div>
                            <div class="modal-body">
                              <form action="#">
                                
                                <input type="radio" name="usefood" value="กะเพราธรรมดา">        กะเพราธรรมดา 60 บาท
                                <br>
                                <input type="radio" name="usefood" value="กะเพราพิเศษ">         กะเพราพิเศษ   65 บาท
                                <br><br>
                                </form> 
                                
                              </div>
                              <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="alert('เพิ่มอาหารลงตะกร้าแล้ว')">ยืนยัน</button>
                          
                          </div>
                          </div>
                      
                          </div>
                          </div>
                </div>
            </div>

            <div class="card">
                    <img src="images/detailfood15.jpg" alt="Avatar" style="width:100%;height:250px;">
                        <div class="container">
                        <h4><b>ข้าวผัด</b></h4>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">เลือก</button>

                    <!-- Modal -->
                <div class="modal fade" id="myModal2" role="dialog">
                  <div class="modal-dialog">
            
                      <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"></button>
                              <img src="images/detailfood15.jpg" style="width:100%;">
                              <h4 class="modal-title" style="text-align:center">ข้าวผัด</h4>
                              
                            </div>
                            <div class="modal-body">
                              <form action="#">
                                
                                <input type="checkbox" name="usefood1" value="ข้าวผัดธรรมดา">        ข้าวผัดธรรมดา 60 บาท
                                <br>
                                <input type="checkbox" name="usefood2" value="ข้าวผัดทะเล">         ข้าวผัดทะเล   65 บาท
                                <br>
                                <input type="checkbox" name="usefood2" value="ข้าวผัดรวม">         ข้าวผัดรวม   70 บาท
                                <br>
                                </form> 
                                
                              </div>
                              <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="alert('เพิ่มอาหารลงตะกร้าแล้ว')">ยืนยัน</button>
                          
                          </div>
                          </div>
                      
                          </div>
                          </div>
                </div>
            </div>

    </section>


    

</body>
</html>
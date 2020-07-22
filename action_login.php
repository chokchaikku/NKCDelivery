<?php 
session_start();
        if(isset($_POST['username'])){
				//connection
                  include("connection.php");
				//รับค่า user & password
                  $username = $_POST['username'];
                  $psw = $_POST['psw'];
				//query 
                  $sql="SELECT * FROM member Where username='".$username."' and psw='".$psw."' ";

                  $result = mysqli_query($con,$sql);
				
                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["member_id"] = $row["member_id"];
                      $_SESSION["username"] = $row["username"];
                      $_SESSION["fullname"] = $row["fullname"];
                      $_SESSION["email"] = $row["email"];
                      $_SESSION["tel"] = $row["tel"];
                      $_SESSION["customer_add"] = $row["customer_add"];
                      $_SESSION["status"] = $row["status"];

                      if($_SESSION["status"]=="2"){ //ถ้าเป็น admin=2 ให้กระโดดไปหน้า admin_page.php
                        echo '<script language="javascript" type="text/javascript"> 
                                      alert("ยินดีต้อนรับแอดมิน");
                                      window.location = "admin_page.php";
                              </script>';

                      }

                      if ($_SESSION["status"]=="1"){  //ถ้าเป็น staff=1 ให้กระโดดไปหน้า staff_page.php
                        echo '<script language="javascript" type="text/javascript"> 
                                      alert("ยินดีต้อนรับพนักงานส่งอาหาร");
                                      window.location = "staff_page.php";
                              </script>';

                      }

                      if ($_SESSION["status"]=="0"){  //ถ้าเป็น users=0 ให้กระโดดไปหน้า index.php
                        echo '<script language="javascript" type="text/javascript"> 
                                      alert("ยินดีต้อนรับ :) ");
                                      window.location = "index.php";
                              </script>';
                      }

                  }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";

                  }

        }else{
            
            
             Header("Location: form_login.php"); //user & password incorrect back to login again

        }
?>
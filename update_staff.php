
<?php
   $con = mysqli_connect("localhost", "root","","nkcfooddelivery");
   mysqli_set_charset($con, "utf8");
   
   $member_id = $_GET["member_id"];
   $username = $_GET["username"];
   $psw = $_GET["psw"];
   $fullname = $_GET["fullname"];
   $email= $_GET["email"];
   $status= $_GET["status"];


   $query = "UPDATE member SET username = '$username',psw = '$psw', fullname='$fullname', email='$email', status='$status' WHERE member_id='$member_id'";
   mysqli_query($con,$query);

   header("Location: admin_fix_staff.php");
   ?>


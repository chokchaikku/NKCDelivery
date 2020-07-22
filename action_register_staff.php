<?php

  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
  //mysqli_set_charset($con,"utf8");
  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
      
      $username = mysqli_real_escape_string($db, $_POST['username']);
      $psw = mysqli_real_escape_string($db, $_POST['psw']);
      $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
      $email = mysqli_real_escape_string($db, $_POST['email']);
      $tel = mysqli_real_escape_string($db, $_POST['tel']);
      $card_id = mysqli_real_escape_string($db, $_POST['card_id']);


  	// image file directory
  	$target = "member/".basename($image);

  	$sql = "INSERT INTO member (username,psw,fullname,email,tel,card_id,image,status) VALUES ('$username','$psw','$fullname','$email','$tel','$card_id','$image','1')";
  	// execute query
    if(mysqli_query($db, $sql))
      {
          echo '<script language="javascript" type="text/javascript"> 
                      alert("สมัครพนักงานส่งอาหารสำเร็จ");
                      window.location = "index.php";
              </script>';
      }

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }

?>


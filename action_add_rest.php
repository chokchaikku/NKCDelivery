<?php

  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
      
      $restaurant_name = mysqli_real_escape_string($db, $_POST['restaurant_name']);
	  $restaurant_detail = mysqli_real_escape_string($db, $_POST['restaurant_detail']);
	  $cost = mysqli_real_escape_string($db, $_POST['cost']);


  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO restaurant (restaurant_name,restaurant_detail,cost,image) VALUES ('$restaurant_name','$restaurant_detail','$cost','$image')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  header('Location: admin_page.php');

?>


<?php

  // Create database connection
  $db = mysqli_connect("localhost", "root","", "nkcfooddelivery");
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
      // Get text
      
      $restaurant_id = mysqli_real_escape_string($db, $_POST['restaurant_id']);
      $food_name = mysqli_real_escape_string($db, $_POST['food_name']);
      $price = mysqli_real_escape_string($db, $_POST['price']);
      $detail = mysqli_real_escape_string($db, $_POST['food_detail']);


  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO food (restaurant_id,food_name,price,detail,image) VALUES ('$restaurant_id','$food_name','$price','$detail','$image')";
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


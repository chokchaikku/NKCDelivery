<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="style_profile.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="style_profile.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
          $member_id = $_GET['member_id'];

          $connect = mysqli_connect("localhost", "root", "", "nkcfooddelivery");
          $product_query = "SELECT * FROM member WHERE member_id='$member_id'";
          $product_result = mysqli_query($connect, $product_query);
          
          if ($product_result):
            if (mysqli_num_rows($product_result)>0):
                while($sub_row = mysqli_fetch_array($product_result)):
          
        ?>
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                        <img src="member/<?php echo $sub_row['image']; ?>"  alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <?php echo '<h5>ชื่อ - นามสกุล : '.$sub_row["fullname"].'<h5>';
                                    ?>
                            <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo '<p>'.$sub_row["username"].'</p>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                                
                                            </div>
                                            <div class="col-md-6">
                                            <?php echo '<p>'.$sub_row["fullname"].'</p>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php echo '<p>'.$sub_row["email"].'</p>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php echo '<p>'.$sub_row["tel"].'</p>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>ที่อยู่</label>
                                            </div>
                                            <div class="col-md-6">
                                            <?php echo '<p>'.$sub_row["customer_add"].'</p>';
                                                ?>
                                            </div>
                                        </div>
                                    
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <a href=""></a><br/>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                       
                            </div>
                           
                        </div>
                    </div>
                </div>
            </form>           
        </div>
        <?php
          endwhile;
        endif;
    endif;
          ?>
</body>
</html>
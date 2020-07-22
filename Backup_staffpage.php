<div id="test" class="w3-container city" style="display:none">
<?php
    $m_id = $_SESSION['member_id']; //สำเร็จ
    $con = mysqli_connect("localhost","root","","nkcfooddelivery");
    mysqli_set_charset($con,"utf8");
    $query_order3 = "SELECT * FROM receive WHERE member_id='$m_id'";
    $res3 = mysqli_query($con, $query_order3);

    ?>
            <br><br>
    <table id="table">
      <thead>
          <tr>
              <th width="50">#</th>
              <th width="150">ออร์เดอร์ลำดับ</th>
              <th width="150">หมายเลขออร์เดอร์</th>
              <th width="150">ราคาอาหารรวม</th>
              <th width="150">ต้องจ่าย</th>
              <th width="100">จ่ายเงิน</th>
          </tr>
      </thead>
    <?php
    $sr = 1;
    while ($row3 = mysqli_fetch_array($res3)){
        ?>
        if()
          <tbody>
            <tr>
                <td>{<?php echo $sr;?>}</td>
                <td><?php echo $row3['orders']; ?></td>
                <td><?php echo $row3['orders_detail']; ?></td>
            </tr>
          </tbody>
            <?php $sr++;}  
        ?>
        </table>
  </div>
</div>
<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: member_login.php');
}
require('../backend/function/connection.php');

$sth = $db->query("SELECT * FROM member WHERE Account='".$_SESSION['Account']."'");
$member = $sth->fetch(PDO::FETCH_ASSOC);
$sth2 = $db->query("SELECT * FROM customer_order WHERE MemberID=".$member['MemberID']);
$orders = $sth2->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-我的訂單</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>會員專區</h1>
				</div>
			</div>
			<div class="body">

			</div>
			<div class="footer">
				<ul class="Category">
					<li><a href="member_edit.php">會員資料修改</a></li>
					<li><a href="my_cart.php">我的購物車</a></li>
					<li><a href="my_orders.php">我的訂單</a></li>
				</ul>
				<div id="OrderForm">
					<h1>我的訂單</h1>
					<table id="order-tables">
                      	<thead>
                      		<tr>
                      			<th width="15%">訂購日期</th>
                      			<th width="40%">訂單編號</th>
                            <th width="10%">總金額</th>
                            <th width="10%">運費</th>
                      			<th width="15%">訂單狀態</th>
                            <th width="10%" style="border-right:1px solid #ebebeb;"></th>
                      		</tr>
                      	</thead>
                        <tbody>
                          <?php foreach($orders as $row){ ?>
                          <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                            <td data-title="訂購日期"><?php echo $row['OrderDate']; ?></td>
                            <td data-title="訂單編號"><?php echo $row['OrderNo']; ?></td>
                            <td data-title="總金額">$NT <?php echo $row['Total']; ?></td>
                            <td data-title="運費">$NT <?php echo $row['Shipping']; ?></td>
                            <td data-title="訂單狀態">
                                <?php
                                if($row['Status'] == 0){
                                  echo "待付款";
                                }else if($row['Status'] == 1){
                                  echo "待出貨 ";
                                }else if($row['Status'] == 2){
                                  echo "出貨中";
                                }else if($row['Status'] == 3){
                                  echo "貨物已送達";
                                }else if($row['Status'] == 99){
                                  echo "取消訂單";
                                } ?>
                            </td>
                            <td data-title="觀看明細" style="border-right:1px solid #ebebeb;"><a href="order_details.php?CustomerOrderID=<?php echo $row['CustomerOrderID'];?>&OrderNo=<?php echo $row['OrderNo'];?> ">觀看明細</a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>

				</div>

			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>

<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: member_login.php');
}
require('../backend/function/connection.php');
$sth = $db->query("SELECT * FROM order_details WHERE CustomerOrderID=".$_GET['CustomerOrderID']);
$details = $sth->fetchAll(PDO::FETCH_ASSOC);
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
					<h1>訂單編號:<?php echo $_GET['OrderNo']; ?></h1>
					<a href="my_orders.php" class="btn btn-default" style="margin-bottom:20px;">回我的訂單</a>
						<table id="order-tables">
            	<thead>
            		<tr>
            			<th width="15%">商品圖片</th>
            			<th width="30%">商品名稱</th>
									<th width="10%" class="price">單價</th>
            			<th width="10%" class="quantity">數量</th>
            			<th width="10%" class="subtotal">小計</th>
            		</tr>
            	</thead>
              <tbody>
                <?php foreach($details as $row){ ?>
                <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
									<td data-title="商品圖片">
											<a href=""><img src="../uploads/product/<?php echo $row['Picture'];?>" alt="" width="200" height="150"></a>
									</td>
									<td class="cart_description" data-title="商品名稱">
											<h4><a href=""><?php echo $row['Name'];?></a></h4>
									</td>
                  <td data-title="單價"><?php echo $row['Price'];?></td>
                  <td data-title="數量"><?php echo $row['Quantity'];?></td>
									<td data-title="小計">$NT <?php echo $row['Price'] * $row['Quantity'];?></td>
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

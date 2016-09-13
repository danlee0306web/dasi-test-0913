<?php session_start();
if(!isset($_SESSION['Account'])){
  header('Location: member_login.php');
}
require('../backend/function/connection.php');
$sth = $db->query("SELECT * FROM member WHERE Account='".$_SESSION['Account']."'");
$member = $sth->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-我的購物車</title>
	<?php require_once("template/files.php"); ?>
	<link rel="stylesheet" href="../assets/css/cart.css">
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
					<h1>商品資訊</h1>

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
								<?php
								 $totalPrice = 0;
								 for($i = 0 ; $i < count($_SESSION['Cart']); $i++){ ?>
                <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
									<td data-title="商品圖片">
											<a href=""><img src="../uploads/product/<?php echo $_SESSION['Cart'][$i]['Picture']; ?>" alt="" width="200" height="150"></a>
									</td>
									<td class="cart_description" data-title="商品名稱">
											<h4><?php echo $_SESSION['Cart'][$i]['Name']; ?></h4>
									</td>
                  <td data-title="單價">$NT <?php echo $_SESSION['Cart'][$i]['Price']; ?></td>
                  <td data-title="數量"><?php echo $_SESSION['Cart'][$i]['Quantity']; ?></td>
									<td data-title="小計">$NT <?php
									$subtotal = $_SESSION['Cart'][$i]['Quantity'] * $_SESSION['Cart'][$i]['Price'];
									$totalPrice += $subtotal;
									echo $subtotal; ?></td>
                </tr>
								<?php }
									$shipping = 80;
									if($totalPrice >= 1000){
										$shipping = 0;
									}
								?>
								<tr>
									<td colspan="4" style="text-align: right;font-weight:bold;">運費</td>
									<td style="text-align: left;font-weight:bold;">$NT <?php echo $shipping; ?></td>
								</tr>
								<tr>
									<td colspan="4" style="text-align: right;font-weight:bold;">總金額</td>
									<td style="text-align: left;font-weight:bold;">$NT <?php echo $totalPrice + $shipping;?></td>
								</tr>
              </tbody>
            </table>
						<hr>
						<h1>訂購資訊</h1>
						<div id="OrderForm">
							<div class="col-md-12">
		            <form class="form-horizontal" role="form" action="order_success.php" method="post">
		              <input type="hidden" class="form-control" name="MM_insert" value="AddForm">
		              <div class="form-group">
		                <div class="col-sm-2">
		                  <label for="OrderName" class="control-label">訂購人</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="OrderName" name="OrderName" value="<?php echo $member['Name']; ?>" >
		                </div>
		              </div>
									<div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Name" class="control-label">收件者</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $member['Name']; ?>">
		                </div>
		              </div>
									<div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Name" class="control-label">聯絡電話</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Phone" name="Phone" value="<?php echo $member['Phone']; ?>">
		                </div>
		              </div>
		              <div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Mobile" class="control-label">行動電話</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Mobile" name="Mobile" value="<?php echo $member['MobilePhone']; ?>">
											<input type="hidden" name="OrderNo" value="<?php echo "CA".date('YmdHis');?>">
											<input type="hidden" name="OrderDate" value="<?php echo date('Y-m-d'); ?>">
											<input type="hidden" name="MemberID" value="<?php echo $member['MemberID']; ?>">
											<input type="hidden" name="Total" value="<?php echo $totalPrice; ?>">
											<input type="hidden" name="Shipping" value="<?php echo $shipping; ?>">
											<input type="hidden" name="CreatedDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
		                </div>
		              </div>
									<div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Email" class="control-label">E-mail</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $member['Email']; ?>">
		                </div>
		              </div>
		              <div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Address" class="control-label">寄送地址</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Address" name="Address" value="<?php echo $member['Address']; ?>">
		                </div>
		              </div>
		              <div class="form-group">
		                <div class="col-sm-10 col-sm-offset-2 text-right">
		                  <button type="submit" class="edit-button cart">確定結帳</button>
		                </div>
		              </div>
		            </form>
		          </div>
						</div>
				</div>

			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>

<?php
session_start();
require('../backend/function/connection.php');

$sql= "INSERT INTO customer_order
          (OrderDate, OrderNo,  Name, Phone, Mobile, Email, Address, Total, Shipping, CreatedDate)
   VALUES (:OrderDate,:OrderNo,:Name, :Phone, :Mobile,:Email, :Address,:Total,:Shipping,:CreatedDate)";
$sth = $db ->prepare($sql);
$sth ->bindParam(":OrderDate", $_POST['OrderDate'], PDO::PARAM_STR);
$sth ->bindParam(":OrderNo", $_POST['OrderNo'], PDO::PARAM_STR);
$sth ->bindParam(":MemberID", $_POST['MemberID'], PDO::PARAM_INT);
$sth ->bindParam(":Name", $_POST['Name'], PDO::PARAM_STR);
$sth ->bindParam(":Phone", $_POST['Phone'], PDO::PARAM_STR);
$sth ->bindParam(":Mobile", $_POST['Mobile'], PDO::PARAM_STR);
$sth ->bindParam(":Email", $_POST['Email'], PDO::PARAM_STR);
$sth ->bindParam(":Address", $_POST['Address'], PDO::PARAM_STR);
$sth ->bindParam(":Total", $_POST['Total'], PDO::PARAM_INT);
$sth ->bindParam(":Shipping", $_POST['Shipping'], PDO::PARAM_INT);
$sth ->bindParam(":CreatedDate", $_POST['CreatedDate'], PDO::PARAM_STR);
$sth ->execute();
//取得最新一筆customer_order 的id值
$sql2 = $db->query("SELECT * FROM customer_order ORDER BY CreatedDate DESC");
$customer_order = $sql2->fetch(PDO::FETCH_ASSOC);
//跑迴圈將session cart的資料寫入order_details資料表
for($i = 0 ; $i < count($_SESSION['Cart']); $i++){
  $createdDate = date('Y-m-d H:i:s');
  $detail_sql = "INSERT INTO order_details
            (CustomerOrderID,Picture, Name, Price, Quantity, CreatedDate)
     VALUES (:CustomerOrderID,:Picture,:Name,:Price,:Quantity,:CreatedDate)";
  $sth2 = $db ->prepare($detail_sql);
  $sth2 ->bindParam(":CustomerOrderID", $customer_order['CustomerOrderID'], PDO::PARAM_INT);
  $sth2 ->bindParam(":Picture", $_SESSION['Cart'][$i]['Picture'], PDO::PARAM_STR);
  $sth2 ->bindParam(":Name", $_SESSION['Cart'][$i]['Name'], PDO::PARAM_STR);
  $sth2 ->bindParam(":Price", $_SESSION['Cart'][$i]['Price'], PDO::PARAM_STR);
  $sth2 ->bindParam(":Quantity", $_SESSION['Cart'][$i]['Quantity'], PDO::PARAM_STR);
  $sth2 ->bindParam(":CreatedDate", $createdDate, PDO::PARAM_STR);
  $sth2 ->execute();
}
unset($_SESSION['Cart']);
?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-訂購成功</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>訂購成功</h1>
				</div>
			</div>
			<div class="body">

			</div>
			<div class="footer">
				<div id="MemberForm">

					<h3>
						您已成功訂購商品，請至「<a href="my_orders.php">我的訂單</a>」查詢訂單進度。
					</h3>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>

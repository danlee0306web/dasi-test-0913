<?php
require('../backend/function/connection.php');
//product資料集
$sql = $db->query("SELECT * FROM product WHERE ProductID=".$_GET['ProductID']);
$product = $sql->fetch(PDO::FETCH_ASSOC);
if(isset($_GET['Existed']) && $_GET['Existed'] == "false"){
	echo "<script>alert('成功加入購物車!')</script>";
}else if(isset($_GET['Existed']) && $_GET['Existed'] == "true"){
	echo "<script>alert('此商品已存在購物車，請至「我的購物車」修改數量')</script>";
}
?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
	<link rel="stylesheet" href="../assets/css/cart.css">
</head>
<script type="text/javascript">
	$(function(){
		var $q = parseInt($('#Quantity').val());

		$('#minus').click(function(){
			if($q > 1){
				$q--;
				$('#Quantity').val($q);
					console.log("q="+$q);
			}
		});
		$('#plus').click(function(){
			$q++;
			//如果沒有限定庫存，就不需要寫判斷式
				$('#Quantity').val($q);
		});
	});
</script>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>產品介紹</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				  <li><a href="#">蛋糕</a></li>
				  <li class="active"><?php echo $product['Name']; ?></li>
				</ol>
				<div id="Product">

					<div class="content-left">
						<img src="../uploads/product/<?php echo $product['Picture']; ?>" alt="">
					</div>
					<div class="content-right">
						<h2><?php echo $product['Name']; ?></h2>
						<form class="" action="add_cart.php" method="post">
							<table id="ProductTable">
								<tr>
									<td width="20%">價格：</td>
									<td class="price">
										<input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
										<input type="hidden" name="Name" value="<?php echo $product['Name']; ?>">
										<input type="hidden" name="Price" value="<?php echo $product['Price']; ?>">
										<input type="hidden" name="Picture" value="<?php echo $product['Picture']; ?>">
										<?php echo $product['Price']; ?>
									</td>
								</tr>

								<tr>
									<td>數量：</td>
									<td>
										<div id="minus" class="quantity-button">
											<i class="fa fa-minus" aria-hidden="true"></i>
										</div>
										<input type="text" id="Quantity" name="Quantity" value="1">
										<div id="plus" class="quantity-button">
											<i class="fa fa-plus" aria-hidden="true"></i>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" class="cart" value="加入購物車"></td>
								</tr>

							</table>
						</form>
					</div>
					<div class="clearboth"></div>
					<hr>
					<p><?php echo $product['Description']; ?></p>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>

<?php
require('../backend/function/connection.php');
//product_category資料集
$sql2 = $db->query("SELECT * FROM product_category");
$product_categorys = $sql2->fetchAll(PDO::FETCH_ASSOC);
//product資料集
$sql = $db->query("SELECT * FROM product WHERE ProductCategoryID=".$_GET['ProductCategoryID']);
$products = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>Products</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				  <li class="active"><a href="#">蛋糕</a></li>
				</ol>
				<ul class="Category">
					<?php foreach($product_categorys as $category){ ?>
					<li><a href="product_category.php?ProductCategoryID=<?php echo $category['ProductCategoryID']; ?>"><?php echo $category['Category'] ?></a></li>
					<?php } ?>
				</ul>
				<ul id="Products">
					<?php foreach($products as $product){ ?>
					<li>
						<a href="product_content.php?ProductID=<?php echo $product['ProductID'];?>"><img src="../uploads/product/<?php echo $product['Picture']; ?>" width="200" height="150" alt=""></a>
						<a href="product_content.php?ProductID=<?php echo $product['ProductID'];?>"><h2><?php echo $product['Name']; ?></h2></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>

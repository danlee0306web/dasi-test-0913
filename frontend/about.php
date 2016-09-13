<?php
session_start();
require('../backend/function/connection.php');
$sth = $db->query("SELECT * FROM page WHERE PageID=".$_GET['PageID']);
$page = $sth->fetch(PDO::FETCH_ASSOC);

//顯示所有page資料
$sql = $db->query("SELECT * FROM page");
$pageAll = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>about - Frozen Yogurt Shop</title>
	<?php include("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php include("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1><?php echo $page['Title'];?></h1>
				</div>
			</div>
			<div class="body">
				<img src="../images/bg-header-about.jpg" alt="">
			</div>
			<div class="footer">
				<div class="sidebar">
					<?php foreach($pageAll as $one){ ?>
					<p>
						<a href="about.php?PageID=1?PageID=<?php echo $one['PageID']; ?>" style="text-decoration:none;"><?php echo $one['Title']; ?></a>
					</p>
					<?php } ?>
				</div>
				<div class="article">
					<?php echo $page['Content'];?>
				</div>
			</div>
		</div>
		<?php include("template/footer.php"); ?>
	</div>
</body>
</html>

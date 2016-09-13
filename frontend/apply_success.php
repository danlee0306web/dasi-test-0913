<?php
session_start();
require('../backend/function/connection.php');

  $sql= "INSERT INTO member
            (Account,
            Password,
						Phone,
            CreatedDate) VALUES (
            :Account,
            :Password,
						:Phone,
            :CreatedDate)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":Account", $_POST['Account'], PDO::PARAM_STR);
  $sth ->bindParam(":Password", $_POST['Password'], PDO::PARAM_STR);
	$sth ->bindParam(":Phone", $_POST['Phone'], PDO::PARAM_STR);
  $sth ->bindParam(":CreatedDate", $_POST['CreatedDate'], PDO::PARAM_STR);
  $sth ->execute();

?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-會員申請</title>
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
				<div id="MemberForm">
					<h2>申請會員成功!</h2>
					<p>
						您已成功加入會員，請至 <a href="member_login.php">登入頁</a>，登入您的帳號，方可進行購物。
					</p>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>

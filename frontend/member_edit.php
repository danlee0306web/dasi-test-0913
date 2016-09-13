<?php
session_start();
require('../backend/function/connection.php');
if(isset($_SESSION['FBID'])){
  $createDate = date('Y-m-d H:i:s');
  $sql2= "INSERT INTO member
            (Account,
						Name,
            CreatedDate) VALUES (
            :Account,
						:Name,
            :CreatedDate)";
  $sth2 = $db ->prepare($sql2);
  $sth2 ->bindParam(":Account", $_SESSION['EMAIL'], PDO::PARAM_STR);
	$sth2 ->bindParam(":Name", $_SESSION['FULLNAME'], PDO::PARAM_STR);
  $sth2 ->bindParam(":CreatedDate", $createDate, PDO::PARAM_STR);
  $sth2 ->execute();
}
if(isset($_POST['MM_update']) && $_POST['MM_update'] == "EditForm"){
  $sql= "UPDATE member SET Name =:Name,
            Gender = :Gender,
						Birthday = :Birthday,
						Phone = :Phone,
						Email = :Email,
						MobilePhone = :MobilePhone,
            Address = :Address,
            UpdatedDate = :UpdatedDate WHERE MemberID=:MemberID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":Name", $_POST['Name'], PDO::PARAM_STR);
  $sth ->bindParam(":Gender", $_POST['Gender'], PDO::PARAM_INT);
  $sth ->bindParam(":Birthday", $_POST['Birthday'], PDO::PARAM_STR);
	$sth ->bindParam(":Phone", $_POST['Phone'], PDO::PARAM_STR);
  $sth ->bindParam(":Email", $_POST['Email'], PDO::PARAM_STR);
  $sth ->bindParam(":MobilePhone", $_POST['MobilePhone'], PDO::PARAM_STR);
  $sth ->bindParam(":Address", $_POST['Address'], PDO::PARAM_STR);
  $sth ->bindParam(":UpdatedDate", $_POST['UpdatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":MemberID", $_POST['MemberID'], PDO::PARAM_INT);
  $sth -> execute();
}
if(isset($_SESSION['FBID'])){
  $sth = $db->query("SELECT * FROM member ORDER BY MemberID DESC");
  $member = $sth->fetch(PDO::FETCH_ASSOC);
}else{
  $sth = $db->query("SELECT * FROM member WHERE Account='".$_SESSION['Account']."'");
  $member = $sth->fetch(PDO::FETCH_ASSOC);
}
 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-會員資料修改</title>
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
				<div id="MemberForm">
					<h1>會員資料修改</h1>

					<form action="member_edit.php" method="post">
						<input type="hidden" name="MM_update" value="EditForm">
						<input type="hidden" name="MemberID" value="<?php echo $member['MemberID']; ?>">
						<table>
								<tr>
									<th>帳號：</th>
									<td><?php echo $member['Account']; ?>
                    <?php if(isset($_SESSION['FBID'])){ ?>
                    <img src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture?type=large">
                    <?php } ?>
                  </td>
								</tr>
								<tr>
									<th>姓名：</th>
									<td>
										<input type="text" name="Name" value="<?php echo $member['Name']; ?>">
										<div class="help-block with-errors"></div>
									</td>
								</tr>
								<tr>
									<th>性別：</th>
									<td>
										<input type="radio" name="Gender" value="0" checked="true"> 男
										<input type="radio" name="Gender" value="1" > 女
									</td>
								</tr>
								<tr>
									<th>生日：</th>
									<td><input type="text" name="Birthday" value="<?php echo $member['Birthday']; ?>"></td>
								</tr>
								<tr>
									<th>聯絡電話：</th>
									<td><input type="text" name="Phone" value="<?php echo $member['Phone']; ?>"></td>
								</tr>
								<tr>
									<th>行動電話：</th>
									<td><input type="text" name="MobilePhone" value="<?php echo $member['MobilePhone']; ?>"></td>
								</tr>
								<tr>
									<th>地址：</th>
									<td><input type="text" name="Address" value="<?php echo $member['Address']; ?>"></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><input type="submit" value="更新資料" id="submit" onclick="alert('更新成功!')"></td>
								</tr>
						</table>
					</form>

				</div>

			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>

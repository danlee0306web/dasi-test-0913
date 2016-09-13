<?php
require('../backend/function/connection.php');
echo $_POST['OrderDate']."<br />";
echo $_POST['OrderNo']."<br />";
echo $_POST['MemberID']."<br />";
echo $_POST['Name']."<br />";
echo $_POST['Phone']."<br />";
$status = 0;
$sql= "INSERT INTO customer_order
          (OrderDate, OrderNo, MemberID, Name, Phone, Mobile, Email, Total, Shipping, CreatedDate)
   VALUES (:OrderDate,:OrderNo,:MemberID,:Name, :Phone, :Mobile,:Email,:Total,:Shipping,:CreatedDate)";
$sth = $db ->prepare($sql);
$sth ->bindParam(":OrderDate", $_POST['OrderDate'], PDO::PARAM_STR);
$sth ->bindParam(":OrderNo", $_POST['OrderNo'], PDO::PARAM_STR);
$sth ->bindParam(":MemberID", $_POST['MemberID'], PDO::PARAM_INT);
$sth ->bindParam(":Name", $_POST['Name'], PDO::PARAM_STR);
$sth ->bindParam(":Phone", $_POST['Phone'], PDO::PARAM_STR);
$sth ->bindParam(":Mobile", $_POST['Mobile'], PDO::PARAM_STR);
$sth ->bindParam(":Email", $_POST['Email'], PDO::PARAM_STR);
$sth ->bindParam(":Total", $_POST['Total'], PDO::PARAM_INT);
$sth ->bindParam(":Shipping", $_POST['Shipping'], PDO::PARAM_INT);
$sth ->bindParam(":CreatedDate", $_POST['CreatedDate'], PDO::PARAM_STR);
$sth ->execute();

 ?>

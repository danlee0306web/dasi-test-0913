<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: login.php');
}
require('../function/connection.php');
$sql = "DELETE FROM product WHERE ProductID=".$_GET['ProductID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php?ProductCategoryID='.$_GET['ProductCategoryID']);
 ?>

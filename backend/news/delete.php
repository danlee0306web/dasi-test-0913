<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: login.php');
}
require('../function/connection.php');
$sql = "DELETE FROM news WHERE NewsID=".$_GET['NewsID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php');
 ?>

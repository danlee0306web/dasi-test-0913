<?php
session_start();
require('function/connection.php');

$sth = $db->query("SELECT * FROM admin WHERE Account='".$_POST['Account']."' AND Password='".$_POST['Password']."'");

$admin = $sth->fetch(PDO::FETCH_ASSOC);

if($admin != NULL){
  $_SESSION['Account'] = $admin['Account'];
  header('Location: news/list.php');
}else{
  header('Location: login.php?ERROR="true"');
}
 ?>

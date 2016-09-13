<?php
session_start();

$is_existed = "false";

  for($i = 0 ; $i < count($_SESSION['Cart']); $i++){
    if($_POST['ProductID'] == $_SESSION['Cart'][$i]['ProductID']){
      $is_existed = "true";
      goto_previousPage($is_existed);
    }
  }

if($is_existed == "false"){
  //將接收的商品資料存到$temp陣列
  $temp['ProductID']    = $_POST['ProductID'];
  $temp['Name']         = $_POST['Name'];
  $temp['Picture']      = $_POST['Picture'];
  $temp['Price']        = $_POST['Price'];
  $temp['Quantity']     = $_POST['Quantity'];
  //將陣列資料加入到session Cart中
  $_SESSION['Cart'][] = $temp;
  goto_previousPage($is_existed);
}
function goto_previousPage($is_existed){
  $url= explode('?',$_SERVER['HTTP_REFERER']);
  $location = $url[0];
  $location.= "?ProductID=".$_POST['ProductID'];
  $location.= "&Existed=".$is_existed;

  header(sprintf('Location: %s', $location));
}

?>

<?php
session_start();

$is_existed    = "false";

//判斷是否重覆加入
for($i=0; $i < count($_SESSION['Cart']); $i++)	{
	if(($_POST['ProductID'] == $_SESSION['Cart'][$i]['ProductID'])) {
		$is_existed = "true"; // 1
		go_to_previous_page($is_existed);
		break;
	}
}// End for
if($is_existed == "false"){

	$temp['ProductID']      = $_POST['ProductID'];
	$temp['Name']    = $_POST['Name'];
	$temp['Picture']        = $_POST['Picture'];
	$temp['Price']        = $_POST['Price'];
	$temp['Quantity']       = $_POST['Quantity'];
	$temp['SubTotal']       = $temp['Quantity'] * $temp['Price'];

	$_SESSION['Cart'][]     = $temp;  //array_push的簡寫法
	go_to_previous_page($is_existed, $is_added);
}

function go_to_previous_page($is_existed){
	$location  = explode('?',$_SERVER['HTTP_REFERER']);
	$location  = $location[0];
	$location .= "?";
	$location .= "ProductID=".$_POST['ProductID'];
	$location .= "&Existed=".$is_existed;

	//echo $location."<br/>";

	header(sprintf("Location: %s", $location));
}

 ?>

<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: login.php');
}
require('../function/connection.php');

if(isset($_POST['MM_update']) && $_POST['MM_update'] == "EditForm"){
  $sql= "UPDATE customer_order SET Status =:Status,

            UpdatedDate = :UpdatedDate WHERE CustomerOrderID=:CustomerOrderID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":Status", $_POST['Status'], PDO::PARAM_INT);
  $sth ->bindParam(":UpdatedDate", $_POST['UpdatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":CustomerOrderID", $_POST['CustomerOrderID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php?Status='.$_POST['Status']);
}
$sth = $db->query("SELECT * FROM customer_order WHERE CustomerOrderID=".$_GET['CustomerOrderID']);
$customer_order = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/jq-ui/jquery-ui.js"></script>
    <script type="text/javascript" src="../../assets/tinymce/tinymce.min.js"></script>
    <script src="../../assets/js/validator.min.js" type="text/javascript"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/jq-ui/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="../../assets/tinymce/skins/lightgray/skin.min.css" rel="stylesheet" type="text/css">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
  </head>
  <script type="text/javascript">
    $(function(){
      $( "#PublishedDate" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
    });
    //Tinymce 程式碼
    tinymce.init({
    language: "zh_TW",
    selector: '#Content',
    height: 500,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_css: [
      '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
      '//www.tinymce.com/css/codepen.min.css'
    ]
  });
  </script>
  <body>
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CakeHouse<br></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">頁面管理 &nbsp;<i class="fa fa-caret-down"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="../page/edit.php?PageID=1">關於我們</a>
                </li>
                <li>
                  <a href="../page/edit.php?PageID=2">購物說明</a>
                </li>
                <li>
                  <a href="../page/edit.php?PageID=3">會員條款</a>
                </li>
              </ul>
            </li>
            <li class="active">
              <a href="../news/list.php">最新消息管理</a>
            </li>
            <li>
              <a href="../product_category/list.php">產品管理<br></a>
            </li>
            <li>
              <a href="#">會員管理</a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">訂單管理 &nbsp;<i class="fa fa-caret-down"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="list.php?Status=0">新訂單</a>
                </li>
                <li>
                  <a href="list.php?Status=1">已付款</a>
                </li>
                <li>
                  <a href="list.php?Status=2">出貨中</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="list.php?Status=3">已出貨</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="list.php?Status=4">已送達(交易完成)</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="list.php?Status=99">取消訂單</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>訂單管理</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li>
                <a href="#">主控台</a>
              </li>
              <li>
                <a href="../news/list.php">訂單管理</a>
              </li>
              <li class="active">編輯-<?php echo $customer_order['OrderNo']; ?></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" action="edit.php" method="post" id="EditForm" data-toggle="validator">
              <input type="hidden" class="form-control" name="MM_update" value="EditForm">
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="OrderDate" class="control-label">訂單日期</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order['OrderDate']; ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="OrderNo" class="control-label">訂單編號</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order['OrderNo']; ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Title" class="control-label">訂單編號</label>
                </div>
                <div class="col-sm-10">
                  <input type="radio" name="Status" value="0" <?php if($customer_order['Status'] == 0) echo "checked"; ?>>&nbsp;新訂單&nbsp;
                  <input type="radio" name="Status" value="1" <?php if($customer_order['Status'] == 1) echo "checked"; ?>>&nbsp;已付款&nbsp;
                  <input type="radio" name="Status" value="2" <?php if($customer_order['Status'] == 2) echo "checked"; ?>>&nbsp;出貨中&nbsp;
                  <input type="radio" name="Status" value="3" <?php if($customer_order['Status'] == 3) echo "checked"; ?>>&nbsp;已出貨&nbsp;
                  <input type="radio" name="Status" value="4" <?php if($customer_order['Status'] == 4) echo "checked"; ?>>&nbsp;已送達(交易完成)&nbsp;
                  <input type="radio" name="Status" value="99" <?php if($customer_order['Status'] == 99) echo "checked"; ?>>&nbsp;取消訂單
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Total" class="control-label">總金額</label>
                </div>
                <div class="col-sm-10" style="font-size:20px; color:#f00;">
                  NT$ <?php echo $customer_order['Total']; ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Name" class="control-label">收件者</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order['Name']; ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Phone" class="control-label">聯絡電話</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order['Phone']; ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Mobile" class="control-label">行動電話</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order['Mobile']; ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Address" class="control-label">寄送地址</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $customer_order['Address']; ?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" class="form-control" id="UpdatedDate" name="UpdatedDate" value="<?php echo date("Y-m-d H:i:s"); ?>">
                  <input type="hidden" class="form-control" id="CustomerOrderID" name="CustomerOrderID" value="<?php echo $customer_order['CustomerOrderID'];?>">
                  <button type="submit" class="btn btn-default">送出</button>
                  <button type="button" class="btn btn-default">取消並回上一頁</button>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
    <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>Cake House</h1>
            <p>2016 © Cake House Co. Ltd. All Right Reserved.
              <br>
              <br>
            </p>
          </div>
        </div>
      </div>
    </footer>


</body></html>

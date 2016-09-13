<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: login.php');
}
require('../function/connection.php');

$query = $db->query("SELECT * FROM order_details WHERE CustomerOrderID=".$_GET['CustomerOrderID']);

$order_details = $query->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($order_details);

 ?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
  </head><body>
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
            <h1>訂單明細管理-<?php echo $_GET['OrderNo']; ?></h1>
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
              <li class="active">訂單明細管理</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="../customer_order/list.php?Status=<?php echo $_GET['Status'];?>" class="btn btn-primary">回訂單列表</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
            <?php if($totalRows > 0){ ?>
            <table class="table">
              <thead>
                <tr>
                  <th>產品圖</th>
                  <th>產品名稱</th>
                  <th>價格</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach($order_details as $row){ ?>
                <tr>
                  <td><img src="../../uploads/product/<?php echo $row['Picture']; ?>" width="200" height="150" alt="" /> </td>
                  <td><?php echo $row['Name']; ?></td>
                  <td><?php echo $row['Price']; ?></td>

                </tr>
                <?php } ?>
              </tbody>
            </table>
              <?php } ?>
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

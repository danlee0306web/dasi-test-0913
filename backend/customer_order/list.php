<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: login.php');
}
require('../function/connection.php');
$limit = 5;
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}
$start_from = ($page-1) * $limit;
$query = $db->query("SELECT * FROM customer_order WHERE Status=".$_GET['Status']." ORDER BY OrderDate DESC LIMIT ".$start_from.",".$limit);

$customer_order = $query->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($customer_order);
if($_GET['Status'] == 0){
  $status =  "新訂單";
}else if($_GET['Status'] == 1){
  $status = "已付款";
}else if($_GET['Status'] == 2){
  $status = "出貨中";
}else if($_GET['Status'] == 3){
  $status = "已出貨";
}else if($_GET['Status'] == 4){
  $status = "已送達(交易完成)";
}else if($_GET['Status'] == 99){
  $status = "取消訂單";
}
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
            <h1>訂單管理-<?php echo $status; ?></h1>
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
              <li class="active">訂單管理</li>
            </ul>
          </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
            <?php if($totalRows > 0){ ?>
            <table class="table">
              <thead>
                <tr>
                  <th>訂單日期</th>
                  <th>訂單編號</th>
                  <th>收件者</th>
                  <th>行動電話</th>
                  <th>地址</th>
                  <th>總金額</th>
                  <th>訂單明細</th>
                  <th>編輯</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($customer_order as $row){ ?>
                <tr>
                  <td><?php echo $row['OrderDate']; ?></td>
                  <td><?php echo $row['OrderNo']; ?></td>
                  <td><?php echo $row['Name']; ?></td>
                  <td><?php echo $row['Mobile']; ?></td>
                  <td><?php echo $row['Address']; ?></td>
                  <td><?php echo $row['Total']; ?></td>
                  <td><a href="../order_details/list.php?Status=<?php echo $_GET['Status'];?>&CustomerOrderID=<?php echo $row['CustomerOrderID']; ?>&OrderNo=<?php echo $row['OrderNo'];?>">訂單明細</a></td>
                  <td><a href="edit.php?CustomerOrderID=<?php echo $row['CustomerOrderID']; ?>" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                  <td><a href="delete.php?CustomerOrderID=<?php echo $row['CustomerOrderID']; ?>" class="btn btn-default" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php }else{ ?>
              <p>
                目前無資料，請新增一筆。
              </p>
              <?php } ?>
          </div>
        </div>
        <?php if($totalRows > 0){
          $sth = $db->query("SELECT * FROM customer_order WHERE Status=".$_GET['Status']." ORDER BY OrderDate DESC");
            $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
            $total_pages = ceil($data_count / $limit);
          ?>
        <div class="row">
          <div class="col-md-12 text-center">
            <ul class="pagination">
              <?php if($page > 1){ ?>
              <li>
                <a href="list.php?Status=<?php echo $_GET['Status'];?>&page=<?php echo $page-1; ?>">上一頁</a>
              </li>
              <?php }else{ ?>
                <li class="disabled">
                  <a href="#" >上一頁</a>
                </li>
              <?php } ?>
              <?php for($i = 1; $i <= $total_pages; $i++){
                if($page == $i){?>
                  <li class="active">
                    <a href="#"><?php echo $i ?></a>
                  </li>
              <?php }else{ ?>
              <li>
                <a href="list.php?Status=<?php echo $_GET['Status'];?>&page=<?php echo $i; ?>"><?php echo $i ?></a>
              </li>
              <?php } } ?>
              <?php if($page < $total_pages){ ?>
              <li>
                <a href="list.php?Status=<?php echo $_GET['Status'];?>&page=<?php echo $page +1 ?>">下一頁</a>
              </li>
              <?php }else{ ?>
                <li class="disabled">
                  <a href="#" >下一頁</a>
                </li>
                <?php } ?>
            </ul>
          </div>
        </div>
        <?php } ?>
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

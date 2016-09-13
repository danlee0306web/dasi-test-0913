<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: login.php');
}
require('../function/connection.php');

if(isset($_POST['MM_update']) && $_POST['MM_update'] == "EditForm"){
  $sql= "UPDATE product_category SET
            Category =:Category,
            UpdatedDate = :UpdatedDate WHERE ProductCategoryID=:ProductCategoryID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":Category", $_POST['Category'], PDO::PARAM_STR);
  $sth ->bindParam(":UpdatedDate", $_POST['UpdatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":ProductCategoryID", $_POST['ProductCategoryID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sth = $db->query("SELECT * FROM product_category WHERE ProductCategoryID=".$_GET['ProductCategoryID']);
$product_categorys = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
  </head>
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
              <a href="../product_category/list.php">最新消息管理</a>
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
                  <a href="#">新訂單</a>
                </li>
                <li>
                  <a href="#">已付款</a>
                </li>
                <li>
                  <a href="#">出貨中</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="#">已出貨</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="#">已送達(交易完成)</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="#">取消訂單</a>
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
            <h1>產品分類管理</h1>
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
              <li class="active">
                <a href="list.php">產品分類管理</a>
              </li>
              <li class="active">新增一筆</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" action="edit.php" method="post" id="EditForm">
              <input type="hidden" class="form-control" name="MM_update" value="EditForm">
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Category" class="control-label">分類名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="Category" name="Category" value="<?php echo $product_categorys['Category']; ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" class="form-control" id="UpdatedDate" name="UpdatedDate" value="<?php echo date("Y-m-d H:i:s"); ?>">
                  <input type="hidden" class="form-control" id="ProductCategoryID" name="ProductCategoryID" value="<?php echo $product_categorys['ProductCategoryID'];?>">
                  <button type="submit" class="btn btn-default">送出</button>
                  <a href="list.php" class="btn btn-default">取消並回上一頁</a>
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

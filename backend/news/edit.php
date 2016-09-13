<?php
session_start();
if(!isset($_SESSION['Account'])){
  header('Location: login.php');
}
require('../function/connection.php');

if(isset($_POST['MM_update']) && $_POST['MM_update'] == "EditForm"){
  $sql= "UPDATE news SET PublishedDate =:PublishedDate,
            Title = :Title,
            Content = :Content,
            UpdatedDate = :UpdatedDate WHERE NewsID=:NewsID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":PublishedDate", $_POST['PublishedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":Title", $_POST['Title'], PDO::PARAM_STR);
  $sth ->bindParam(":Content", $_POST['Content'], PDO::PARAM_STR);
  $sth ->bindParam(":UpdatedDate", $_POST['UpdatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":NewsID", $_POST['NewsID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sth = $db->query("SELECT * FROM news WHERE NewsID=".$_GET['NewsID']);
$news = $sth->fetch(PDO::FETCH_ASSOC);
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
            <h1>最新消息管理</h1>
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
                <a href="../news/list.php">最新消息管理</a>
              </li>
              <li class="active">新增一筆</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" action="edit.php" method="post" id="EditForm" data-toggle="validator">
              <input type="hidden" class="form-control" name="MM_update" value="EditForm">
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="PublishedDate" class="control-label">發佈日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="PublishedDate" name="PublishedDate" value="<?php echo $news['PublishedDate']; ?>" data-error="請選擇發佈日期" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Title" class="control-label">新聞標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="Title" name="Title" value="<?php echo $news['Title']; ?>" data-error="請輸入新聞標題" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="Content" class="control-label">新聞內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="Content"><?php echo $news['Content']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" class="form-control" id="UpdatedDate" name="UpdatedDate" value="<?php echo date("Y-m-d H:i:s"); ?>">
                  <input type="hidden" class="form-control" id="NewsID" name="NewsID" value="<?php echo $news['NewsID'];?>">
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

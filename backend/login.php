<!DOCTYPE html>
<?php
session_start();
require('function/connection.php');
if(isset($_POST['MM_login']) && $_POST['MM_login'] = "Login"){
  $sth =
  $db->query("SELECT * FROM admin WHERE Account='".$_POST['Account']."' AND Password='".$_POST['Password']."'");

  $admin = $sth->fetch(PDO::FETCH_ASSOC);

  if($admin != NULL){
    $_SESSION['Account'] = $admin['Account'];
    header('Location: news/list.php');
  }else{
    header('Location: ../login.php?ERROR="true"');
  }
}
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cake House 後台管理系統</title>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div class = "container">
    	<div class="wrapper">
    		<form action="login.php" method="post" name="Login_Form" class="form-signin">
    		    <h3 class="form-signin-heading">Cake House 後台管理系統</h3>
    			  <hr class="colorgraph"><br>

    			  <input type="text" class="form-control" name="Account" placeholder="使用者名稱" required="" autofocus="" />
    			  <input type="password" class="form-control" name="Password" placeholder="密碼" required=""/>
            <input type="hidden" name="MM_login" value="Login">
    			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">登入</button>
            <?php if(isset($_GET['ERROR'])){ ?>
            <div class="alert alert-danger" role="alert" style="margin-top:10px;">
              <strong>登入錯誤!</strong> 請確認您的帳號密碼是否正確。
            </div>
            <?php } ?>
        </form>

    	</div>
    </div>
  </body>
</html>

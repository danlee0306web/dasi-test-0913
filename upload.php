<?php

  $file = $_FILES['Picture']['name'];
  move_uploaded_file($_FILES['Picture']['tmp_name'],"uploads/test/".$file);   // 搬移上傳檔案
  echo "上傳成功";

 ?>

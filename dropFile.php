<?php



if (!unlink($_GET["fileUrl"]))

  {

  echo "<script>alert('删除文件错误： " . $file . "')</script>";

  }



  echo '<script>location.href="allFiles.php"</script>';

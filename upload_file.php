<?php

 session_start();

 include_once"header.php"; 

 include_once"config.php";

 include_once"files.class.php";

 $up_img_directory = "upload" . "/";

 $config_directory = "configure" . "/";

 $out_img_directory = "out" . "/";

?>

    <title>图片转base64</title>

</head>

<body>

	<div class="header">

		<h3>图片转base64编码</h3>

    </div>

    

    <div class="content">

        <ol>

<?php

/********上传文件开始*************/

/*上传文件信息保存在session中*/

if($_FILES <> NULL){

    xml("loadFiles.xml", "w", $_FILES["file"]["name"], $_FILES["file"]["type"], $_FILES["file"]["size"], $_FILES["file"]["tmp_name"], $_FILES["file"]["error"]);

}

  $arrKey = array("name", "type", "size", "tmp_name", "error");

  $arrFile = array_combine($arrKey, xml("loadFiles.xml", "r"));

// 允许上传的图片后缀

$allowedExts = array("gif", "jpeg", "jpg", "png");

$temp = explode(".", $arrFile["name"]);

$extension = end($temp);     // 获取文件后缀名

if ((($arrFile["type"] == "image/gif")

|| ($arrFile["type"] == "image/jpeg")

|| ($arrFile["type"] == "image/jpg")

|| ($arrFile["type"] == "image/pjpeg")

|| ($arrFile["type"] == "image/x-png")

|| ($arrFile["type"] == "image/png"))

&& ($arrFile["size"] < 20480000)   // 小于 200 kb

&& in_array($extension, $allowedExts))

{

    if ($arrFile["error"] > 0)

    {

        echo "<li>错误：: " . $arrFile["error"] . "</li>";

    }

    else

    {

        echo "<li class='first'>上传文件名:<br/> " . $arrFile["name"] . "</li>";

        echo "<li class='middle'>文件类型: <br/>" . $arrFile["type"] . "</li>";

        echo "<li class='middle'>文件大小: <br/>" . round($arrFile["size"] / 1024, 2) . " kB</li>";

        echo "<li class='middle'>文件临时存储的位置: <br/>" . $arrFile["tmp_name"] . "</li>";

        

        // 判断当期目录下的 upload 目录是否存在该文件

        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777

  $newFileNane = "img-".date("YmdHis").rand(0, 9999);/*没有用上*/

        if (file_exists($up_img_directory . $arrFile["name"]))

        {

            echo "<li class='middle'>" . $arrFile["name"] . " 文件已经存在。 </li>";

        }

        else

        {

            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下

            move_uploaded_file($arrFile["tmp_name"], $up_img_directory . $arrFile["name"]);

            echo "<li class='middle'>文件存储在: <br/>" . $up_img_directory . $arrFile["name"] . "</li>";

        }

    }

}

else

{

    exit("非法的文件格式");

}

/**********文件上传结束**************/

/*图片转换为 base64格式编码*/  

$img = $up_img_directory . $arrFile["name"]; 

$base64_img = base64EncodeImage($img);

$base64_img_out = imgJiemi(108, $base64_img);

echo '<li class="middle-img"><div class="img-box"><img src="' . $base64_img_out . '" width="60%"/></div></li>';  

/******字符串压缩*********/

$baseImg = $base64_img;

/*******写文件开始********/

/*要创建的文件*/

 /*$fileName*/

$f_size = round(filesize($config_directory . $fileName)/1024, 2);

$f_size_in = round($arrFile["size"] / 1024, 2);

$f_size_cha = $f_size - $f_size_in;

$f_size_bfb = round(($f_size_cha/$f_size_in)*100, 2);

writeContent($config_directory . $fileName, $baseImg);

echo '<li class="middle">文件“' . $fileName . '”的大小:' . $f_size . 'KB</li>';

echo '<li class="middle">原文件的大小:' . round($arrFile["size"] / 1024, 2) . 'KB</li>';

echo '<li class="middle">文件发泡大小：' . $f_size_cha . 'KB</li>';

echo '<li class="middle">文件发泡率：' . $f_size_bfb . '%</li>';

if($outFileOk){  /*$outFileOk在config.php内*/

    $Extension = pathinfo($arrFile["name"],PATHINFO_EXTENSION);

    $outFlie = $out_img_directory . basename($arrFile["name"], $Extension) . $newExtension;

    writeContent($outFlie, $baseImg);

}

/************写文件结束************/

?>

</ol>

<!--<p><b>base64编码：</b></p>

   <div class="text-box">

      <textarea id="textin" rows="30" cols="40" autofocus >

         文档正在处理中……

       </textarea>

    </div>-->

</div>

    <div class="footer"></div>

<!--<script>

  var str = <?php echo json_encode($baseImg)?>;

   document.getElementById("textin").value = str;

</script>-->

</body>

</html>

<?php

if($forceDeleteFile){

   

   $allFile_result_arr = my_dir("upload");

   foreach($allFile_result_arr AS $value){

            $imgUrl = $up_img_directory . $value;

            $session_fn = $up_img_directory . $arrFile["name"];

            if (!unlink($imgUrl)){

                 echo "<script>alert('删除文件错误：$imgUrl')</script>";

             }

      }

}else{

   $allFile_result_arr = my_dir($up_img_directory);

   foreach($allFile_result_arr AS $value){

            $imgUrl = $up_img_directory . $value;

            $session_fn = $up_img_directory . $arrFile["name"];

      if($session_fn <> $imgUrl){

            if (!unlink($imgUrl)){

                 echo "<script>alert('删除文件错误：$imgUrl')</script>";

             }

       }

    }

}

?>

<?php

include_once"config.php";

include_once"files.class.php";

$config_directory = "configure" . "/";

$file=fopen($config_directory . $fileName,"r") or exit("Unable to open file!");

$str_img = '';

while(!feof($file))

{

    $str_img =  $str_img.fgets($file);

}

 fclose($file);

 

  $base64_img_out = imgJiemi(108, $str_img);

  include_once"header.php";

?>

    <title>图片显示</title>

</head>

<body>

	<div class="header">

       <h2>图片显示</h2>

    </div>

    

    <div class="content">

       <img src="<?php echo $base64_img_out; ?>" width="100%" />

    </div>

    

    <div class="footer">

         <p>这是由“<?php echo $fileName; ?>”文件生成的图片！<a href="<?php echo $config_directory .$fileName; ?>" target="_blank">文件下载</p>

   </div>

 </body>

</htm1>

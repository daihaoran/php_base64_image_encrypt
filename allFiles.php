<?php

   session_start();

   include_once"header.php"; 

   include_once("files.class.php");



   $allFile_result_arr = my_dir("upload");

?>



</head>

<body>

	<div class="header" style="text-align: left">

      <a href="showImg.php" class="back a-button">显示图片</a>

	   <h2>缓存图片遍历</h2>

	</div>

	<div class="content">

       <ol>

<?php



       $arrKey = array("name", "type", "size", "tmp_name", "error");

  $arrFile = array_combine($arrKey, xml("loadFiles.xml", "r"));



     foreach($allFile_result_arr AS $value){

            $imgUrl = 'upload/' . $value;

            $xml_fn = 'upload/' . $arrFile["name"];



?>

            <li class="middle"><img src="<?php echo $imgUrl; ?>" height="160px" />

<?php

    if($xml_fn <> $imgUrl){

?>

 <a class="a-all-files a-button" href="dropFile.php?fileUrl=<?php echo $imgUrl; ?>">删除</a>



<?php

      }

?>

           </li>       

<?php

     }

?>

       </ol>

   </div>



  <div class="footer"></div>

</body>

</html>

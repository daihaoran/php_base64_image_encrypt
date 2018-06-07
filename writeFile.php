<?php

   include_once("header.php"); 

   include_once("config.php");

?>

   <title>写配置</title>

<style>

    .error {

          color: #FF0000;

               }

    .w-input{

         width: 120px;

         border-radius: 5px;

         padding: 4px;

         border: solid 1px #666;

               }

    .w-button{

         font-size: 18px;

         background-color: #d2691e;

              }

</style>

</head>

<body>

	<div class="header">

	   <h2>写配置</h2>

	</div>

<?php

function test_input($data)

{

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;

}

  if($_SERVER["REQUEST_METHOD"] == "POST"){

      $u_nameErr = $u_extensionErr = "";

     $u_name = $u_extension = $u_outFileOk = $u_forceDeleteFile = "";

          if (empty($_POST["name"])){

                $u_nameErr = "文件名是必需的";

          }else{

                $u_name = test_input($_POST["name"]);

               // 检测文件名是否只包含字母跟空格

               if (!preg_match("/^[a-zA-Z ]*$/",$u_name)){

                         $u_nameErr = "只允许字母和空格"; 

                 }

          }

    

    if (empty($_POST["extension"])){

           $u_extensionErr = "扩展名是必需的";

      }else{

          $u_extension = test_input($_POST["extension"]);

          // 检测扩展名是否合法

          if (!preg_match("/^[a-zA-Z ]*$/",$u_extension)){

              $u_extensionErr = "只允许字母和空格"; 

            }

      }

       if (empty($_POST["outFileOk"])){

             $u_outFileOk = 'false';

        }else{

             if(test_input($_POST["outFileOk"])=="okk"){

                   $u_outFileOk = 'true';

               }else{

                   $u_outFileOk = 'false';

               }

        }

    

   if (empty($_POST["forceDeleteFile"])){

        $u_forceDeleteFile = 'false';

     }else{

        if(test_input($_POST["forceDeleteFile"])=="is"){

              $u_forceDeleteFile = 'false';

          }else{

              $u_forceDeleteFile = 'true';

          }

      }

    

   if($u_nameErr=='' AND $u_extensionErr==''){

        $i_name = $u_name;

        $i_extension = $u_extension;

        $i_outFileOk = $u_outFileOk;

        $i_forceDeleteFile = $u_forceDeleteFile;

     }else{

        echo '<script>alert("由于文件名或扩展名有误，配置文件已采用默认设置！")</script>';

        $i_name = "img";

        $i_extension = "obj";

        $i_outFileOk = 'false';

        $i_forceDeleteFile = 'false';

    }

/*写文件*/

    $myfile = fopen("config.php", "w") or die("Unable to open file!");

    /*$name            = "img";

    $extension    = "obj";

    $outFileOk       ="false";

    $forceDeleteFile = "false";*/

$arr_str = array("<?php\n", 

                 "\$name = $i_name;  /*文件名*/", 

                 "\$newExtension = $i_extension;  /*扩展名*/",

                 "\$outFileOk = $i_outFileOk;  /*是否允许写输出？*/", 

                 "\$forceDeleteFile = $i_forceDeleteFile;  /*true暴力删除，false只留现在一张图片*/\n", 

                 "\$fileName = \$name . \".\" . \$newExtension;" );

   $content = join("\n", $arr_str);

  if(strlen(fwrite($myfile, $content)) > 0){

      echo '<script>alert("文件写入成功！")</script>';

    }

   fclose($myfile);

}

?>

<div class="content">

    <p><span class="error">* 必需字段。</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

   文件名: <input class="w-input" type="text" name="name" value="<?php

    if(isset($u_name)){

        echo $u_name;

    }else{

        echo $name;

    }

?>">

   <span class="error">* <?php echo $u_nameErr;?></span>

   <br><br>

   扩展名: <input class="w-input" type="text" name="extension" value="<?php

    if(isset($u_extension)){

         echo $u_extension;

     }else{

         echo $newExtension;

     }

?>">

   <span class="error">* <?php echo $u_extensionErr;?></span>

   <br><br>

   base64文件是否输出:

   <input type="radio" name="outFileOk" <?php

    if (isset($u_outFileOk) && $u_outFileOk=='true'){

           echo 'checked="checked"';

     }elseif(!isset($u_outFileOk) && $outFileOk){

           echo 'checked="checked"';

    }

?>  value="okk">是

   <input type="radio" name="outFileOk" <?php

    if (isset($u_outFileOk) && $u_outFileOk=='false'){

           echo 'checked="checked"';

     }elseif(!isset($u_outFileOk) && !$outFileOk){

           echo 'checked="checked"';

     }

?>  value="no">否

   <span class="error">* <?php echo $u_outFileOkErr;?></span>

   <br><br>

   图片是否缓存:

   <input type="radio" name="forceDeleteFile" <?php

     if (isset($u_forceDeleteFile) && $u_forceDeleteFile=='false'){

           echo 'checked="checked"';

      }elseif(!isset($u_forceDeleteFile) && !$forceDeleteFile){

           echo 'checked="checked"';

      }

?>  value="is">是

   <input type="radio" name="forceDeleteFile" <?php

       if (isset($u_forceDeleteFile) && $u_forceDeleteFile=='true'){

           echo 'checked="checked"';

       }elseif(!isset($u_forceDeleteFile) && $forceDeleteFile){

           echo 'checked="checked"';

       }

?>  value="noo">否

   <span class="error">* <?php echo $u_forceDeleteFileErr;?></span>

   <br><br>

   <input class="w-input w-button" type="submit" name="submit" value="确定"> 

</form>

</div>

<div class="footer"></div>

</body>

</html>

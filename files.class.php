<?php

/**************.函数start.*****************/

/**

 * 返回可读文件大小。

 */

function HumanReadableFilesize($size) {

    $mod = 1024;

    $units = explode(' ','B KB MB GB TB PB');

    for ($i = 0; $size > $mod; $i++) {

        $size /= $mod;

    }

    return round($size, 2) . ' ' . $units[$i];

}

/**

   *base64编码函数

  **/

function base64EncodeImage ($image_file) {  

/**

    *图片加密函数

 **/

  function strjami($num, $str){

     $qian = substr($str, 0, $num) . rand(10, 99);

     $hou = substr($str, $num);

     return $qian.$hou;

  }

    $base64_image = '';  

    $image_info = getimagesize($image_file);  

    $image_data = fread(fopen($image_file, 'r'), filesize($image_file));  

    /*$base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data)); */

$base64_image = chunk_split(base64_encode($image_data)).'data:' . $image_info['mime'] . ';base64,';

    return gzdeflate(strjami(108,$base64_image));  

} 

/**

    *图片解密函数

 **/

function imgJiemi($num, $str){

   $str = gzinflate($str);

   $qian = substr($str, 0, $num);

   $hou = substr($str, $num+2);

    /*字符串拼接*/

    $img_str_0 = $qian.$hou;

    $img_str_1 = strstr($img_str_0,"data:");

    $img_str_2 = str_replace(strstr($img_str_0,"data:"),"",$img_str_0);

    $base64Img_out = $img_str_1. $img_str_2;

    return $base64Img_out;

}

/**

    *写文件函数

 **/

function writeContent($fileName, $StrConents){

/*以读写方式打写指定文件，如果文件不存在则创建*/

  if( ($TxtRes=fopen ($fileName,"w+")) === FALSE){

     echo("<li class='middle'>创建可写文件：".$fileName . "失败！</li>");

     exit();

    }

    echo ("<li class='middle'>创建可写文件".$fileName . "成功！</li>");

/*要写进文件的内容$StrConents*/

    if(!fwrite ($TxtRes,$StrConents)){ /*将信息写入文件*/

        echo ("<li class='middle'>尝试向文件".$fileName."写入失败！</li>");

        fclose($TxtRes);

        exit();

     }

    echo ("<li class='middle'>尝试向文件".$fileName."写入成功！</li>");

    fclose ($TxtRes); /*关闭指针*/

 }

/*遍历文件函数.start.*/

    function my_dir($dir) {

       $files = array();

       if(@$handle = opendir($dir)) { /*注意这里要加一个@，不然会有warning错误提示*/

        while(($file = readdir($handle)) !== false) {

            if($file != ".." && $file != ".") { //排除根目录；

                if(is_dir($dir."/".$file)) { //如果是子文件夹，就进行递归

                      $files[$file] = my_dir($dir."/".$file);

                  } else { //不然就将文件的名字存入数组；

                      $files[] = $file;

                  }

 

              }

          }

        closedir($handle);

        return $files;

      }

}

/*遍历函数.END.*/

/*xml函数*/

/**$_file xml文件url

   *$_worr xml文件读写开关，“w”是写，“r”是读

   *其它是xml的文档节点

  **/

function xml($_file, $_worr, $_name="", $_type="", $_size="", $_tmp_name="", $_error=""){

          //var_dump($_worr);

	if(file_exists($_file))//判断文件是否存在

	     {

		if($_worr == "w")

		   {

		        //如果存在就更新内容

	            $doc = new DOMDocument();//实例化对像

	            $doc->load($_file);//载入文件

	            $name = $doc->getElementsByTagName("name");//获取元素是name

	            $name->item(0)->nodeValue = $_name;//对指定元素赋值

	            $type = $doc->getElementsByTagName("type");//获取元素是type

	            $type->item(0)->nodeValue = $_type;//对指定元素赋值

	            $size = $doc->getElementsByTagName("size");//获取元素是type

	            $size->item(0)->nodeValue = $_size;//对指定元素赋值

	            $tmp_name=$doc->getElementsByTagName("tmp_name");//获取元素是type

	            $tmp_name->item(0)->nodeValue = $_tmp_name;//对指定元素赋值

	            $error = $doc->getElementsByTagName("error");//获取元素是type

	            $error->item(0)->nodeValue = $_error;//对指定元素赋值

	            $doc->save($_file);//当有用到修改时才用此方法

		        }elseif($_worr == "r"){

		

		        $arr_result = array();

                $doc = new DOMDocument();//实例化对像

	            $doc->load($_file);//载入文件

	            $name = $doc->getElementsByTagName("name");//获取元素是name

	            $arr_result[0] = $name->item(0)->nodeValue;

	            $type = $doc->getElementsByTagName("type");//获取元素是type

	            $arr_result[1] = $type->item(0)->nodeValue;

	            $size = $doc->getElementsByTagName("size");//获取元素是size

	            $arr_result[2] = $size->item(0)->nodeValue;

	            $tmp_name=$doc->getElementsByTagName("tmp_name");//获取元素是tmp_name

	            $arr_result[3] = $tmp_name->item(0)->nodeValue;

	            $tmp_name=$doc->getElementsByTagName("error");//获取元素是error

	            $arr_result[4] = $tmp_name->item(0)->nodeValue;

	             return $arr_result;

            }else{echo "\$_worr值错误！";}

            

         }else{

             

            $doc = new DOMDocument('1.0', 'utf-8');//申明是XML

            $doc->formatOutput = true;//格式输出

            $root=$doc->createElement('files');//创建根元素

            $name=$doc->createElement("name","");//创建元素并赋值内容

            $type=$doc->createElement("type","");

            $size=$doc->createElement("size","");

            $tmp_name=$doc->createElement("tmp_name","");

            $error=$doc->createElement("error","");

            $root->appendChild($name);//根元素包含子元素

            $root->appendChild($type);

            $root->appendChild($size);

            $root->appendChild($tmp_name);

            $root->appendChild($error);

            $doc->appendChild($root);//结束建立根元索

            $doc->save($_file);//生成xml文件

	     }

}

/********xml函数END.*********/

/*检测表单输入*/

function test_input($data)

{

  $data = trim($data);

  $data = stripslashes($data);

  $data = htmlspecialchars($data);

  return $data;

}

/************.函数END.****************/

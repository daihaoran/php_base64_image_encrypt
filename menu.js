$(document).ready(function(){

   $(".header").append("<ol class='menu'></ol>");

   $(".menu").append("<li><a href='index.php'>文件输入</a></li>");

   $(".menu").append("<li><a href='upload_file.php'>文件生成</a></li>");

   $(".menu").append("<li><a href='showImg.php'>显示图片</a></li>");

   $(".menu").append("<li><a href='allFiles.php'>缓存图片遍历</a></li>");

   $(".menu").append("<li><a href='writeFile.php'>写配置</a></li>");

   $(".menu").after("<div class='box-a'></div>");



    $(".menu").css({

              "width":"98%",

              "position":"absolute",

              "top":"65px",

              "border" : "solid 2px #778899",

              "display" : "none",

              "box-shadow" : "0px 0px 10px #000080",

              "background-color": "#778899",

              "z-index" : "999999"

              

     });



var res = Math.floor(($(window).width()-$(".menu").width())/3) + "px";



      $(".menu").css({"left": res});





     $(".menu>li").css({

              "padding" : "4px 30px",

              "border" : "solid 1px #778899",

              "background-color": "#c8c8c8",

              "border-radius": "6px",

              "text-align": "left"

       });



      $(".box-a").css({ /*遮罩层*/

               "width" : "100%",

               "height" : ($(window).height()) + "px",

               "background" : "#FFF",

               "position" : "absolute",

               "top" : "0px",

               "left" : "0px",

                "opacity" : "0.8",

                "display" : "none",

               "z-index" : "99999"

      });

     

     $('.box-a').bind("touchmove",function(event){

           event.preventDefault();

      });



     $('.menu').bind("touchmove",function(event){

           event.preventDefault();

      });



/*菜单*/

     $(".header").append("<a class='menu-button'>菜单</a>");

     $(".menu-button").after("<a class='menu-button-after'></a>");

     $(".menu-button").css({

                  "position" : "absolute",

                   "top" : "16px",

                   "left" : "3px",

                   "background-color" : "#888",

                   "border": "solid 1px #666",

                   "padding": "3px 6px",

                   "display": "inline-block",

                   "border-radius": "20px",

                   "padding" : "4px 30px",

                   "z-index" : "99999"

           });



       $(".menu-button-after").css({

                 "position" : "absolute",

                  "top" : "46px",

                  "left" : "38px",

                  "display" : "none",

                  "border-style" : "solid",

                  "border-width" : "14px",

                  "border-color" : "#FF4500 transparent transparent transparent",

                 "z-index" : "99999"



         });

      var tag = true;

      var eTime;

    $(".menu-button").on("click",function(){

          if(tag){

                 tag = false;

                 $(".menu").slideDown("1000");

                 $(".box-a").fadeIn("1000");

                 $(".menu-button").css({

                          "background-color" : "#FF4500"

                    });

            $(".menu-button-after").slideDown("1000");



            clearTimeout(eTime);

            eTime = setTimeout(function(){

                      $(".menu").slideUp("slow");

                      $(".box-a").fadeOut("1000");

                      $(".menu-button").css({

                              "background-color" : "#888"

                        });

                  $(".menu-button-after").slideUp("1000");



               }, 10000);

           }else{

                 tag = true;

                 $(".menu").slideUp("slow");

                 $(".box-a").fadeOut("3000");

                 $(".menu-button").css({

                          "background-color" : "#888"

                    });

             $(".menu-button-after").slideUp("1000");

 

           }

    });

});

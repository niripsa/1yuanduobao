<?php

exit;

$html = '
        <!doctype html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                <title>YunGouCMS</title>
                <meta name="keywords" content="云购网,云购源码,云购系统,1元云购,一元云购" />
                <meta name="description" content="韬龙网络公司是目前国内唯一的云购源码授权服务提供商。旗下的云购系统是国内领先的PHP云购源码，是精仿1元云购、一元云购的云购网，保留版权的前提下可免费使用、免费升级，如需要去版权请购买授权和服务。" />
            </head>
            <style>
                html,body{padding: 0; margin: 0;height: 100%; background:#FF7D27 ; font-family: "微软雅黑";overflow: hidden;text-align: center; perspective:1200px;}

                .border{
                    width:60%; margin: auto auto; cursor: pointer;  margin-top: 100px;
                    text-align: center; color: #f60; background: #fff; border-radius: 30px; line-height: 85px;

                    transform:rotateY(0deg);
                    -webkit-animation:"photoRotate3" 3s ease-in-out 1;
                }


                @-webkit-keyframes "photoRotate3" {
                    0% {
                        -webkit-transform:rotateY(0deg);
                    }
                    33% {
                        -webkit-transform:rotateY(-30deg);
                        background: #f60;
                    }
                    66% {
                        -webkit-transform:rotateY(30deg);
                         background: #f60;
                    }
                    100% {
                        -webkit-transform:rotateY(0deg);
                    }
                }

                @-webkit-keyframes "photoRotate4" {
                    0% {
                        margin-top: 0px;filter:alpha(opacity=0); opacity:0;
                    }
                    100% {
                        margin-top: 100px;filter:alpha(opacity=100); opacity:1;
                    }
                }

                    #install{ background:#fff;color:#000}
                h3{
                      -webkit-animation:"photoRotate4" 1s;
                      border-radius: 5px;
                      background-color: #31C552;
                      color: #fff;
                      display: inline-block;
                      padding: 8px 50px;
                      height: 36px;
                      line-height: 36px;
                      width: auto !important;
                      transition: all 0.5s;
                      position: relative;
                      cursor: pointer;
                      margin-top: 100px;
                      font-weight: 100;
                }
                .footer{
                     font-size: 12px; color: #111; position: absolute; bottom:0px; line-height:25px;text-align: center; width: 100%;
                }
                #install{ background:#fff;color:#333}
            </style>
            <body>
                <div class="border">
                    <h1>{ 你还未安装哟 }</h1>
                </div>
                <h3 id="install">安装软件</h3>　　　<h3 id="button">购买授权</h3>
                <div class="footer">
                    Copyright © 2012 - <script type="text/javascript">document.write(new Date().getFullYear())</script> <a href="http://www.yungoucms.com">YunGouCMS</a> All Rights Reserved
                </div>
                <script type="text/javascript">
                    document.getElementById("button").onclick = function(){
                        window.open("http://www.yungoucms.com?go=app");
                    }
                    document.getElementById("install").onclick = function(){                        
                        window.location.href = "./install";
                    }
                </script>
            </body>
        </html>
        ';
 
     
if(isset($_GET['index'])){
    rename(dirname(__FILE__)."/index.public.php",dirname(__FILE__)."/index.php");
    sleep(1);
    echo "<script>window.location.href = '../'; </script>";
}else{
    echo $html;
}
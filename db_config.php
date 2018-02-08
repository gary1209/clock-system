<?php
// $my_db = mysqli_connect("localhost","taipeinew2018","s8CuUrjUcnTAZuHf");
// 	mysqli_select_db($my_db,"waywin_new2018");

// if(!@mysqli_connect("localhost","taipeinew2018","s8CuUrjUcnTAZuHf")){
//         die("無法對資料庫連線");}

// if(!@mysqli_select_db($my_db,"waywin?new2018")){
//         die("無法使用資料庫");}

$my_db = mysqli_connect("localhost","root","");
mysqli_select_db($my_db,"clock-system");


if(!@mysqli_connect("localhost","root","")){
        die("無法對資料庫連線");}

if(!@mysqli_select_db($my_db,"clock-system")){
        die("無法使用資料庫");}

mysqli_query($my_db,"SET NAMES 'utf8'");
?> 
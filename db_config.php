<?php
// $my_db = mysqli_connect("localhost","taipeinew2018","s8CuUrjUcnTAZuHf");
// 	mysqli_select_db($my_db,"waywin_new2018");

// if(!@mysqli_connect("localhost","taipeinew2018","s8CuUrjUcnTAZuHf")){
//         die("無法對資料庫連線");}

// if(!@mysqli_select_db($my_db,"waywin?new2018")){
//         die("無法使用資料庫");}

// $my_db = mysqli_connect("localhost","root","");
// mysqli_select_db($my_db,"clock-system");


// if(!@mysqli_connect("localhost","root","")){
//         die("無法對資料庫連線");}

// if(!@mysqli_select_db($my_db,"clock-system")){
//         die("無法使用資料庫");}

// mysqli_query($my_db,"SET NAMES 'utf8'");
// mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
// mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server   = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db       = substr($cleardb_url["path"],1);

$active_group = 'default';
$query_builder = TRUE;

$my_db = mysqli_connect($cleardb_server,$cleardb_username,$cleardb_password);
 mysqli_select_db($my_db,$cleardb_db);

if(!@mysqli_connect($cleardb_server,$cleardb_username,$cleardb_password)){
        die("無法對資料庫連線");}

if(!@mysqli_select_db($my_db,$cleardb_db)){
        die("無法使用資料庫");}
?>



<!-- mysql -u b0234cf37199b4 -h us-cdbr-iron-east-05.cleardb.ne -p heroku_0e894feeecff4fb -->
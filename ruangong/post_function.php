<?php
header("Access-Control-Allow-Origin:*");
include 'connect.php';     //调用connect.php文件
$func = $_POST['func'];
$room_addr = $_POST['room_addr'];
$capacity = $_POST['capacity'];
$introduction = $_POST['introduction'];
$labels = $_POST['labels'];
$image = $_POST['image'];

if ($pdo->connect_error) {
	die("连接失败：".$con->connect_error);
}
else 
{
 	$sql="CALL ".$func."(\"".$room_addr."\",".$capacity.",\"".$introduction."\",\"".$labels."\",\"".$image."\")";//根据传入的参数查询数据库中的数据
 	$res=$pdo->query($sql);
 	if ($res){
 	    $message['valid'] = 1;
 	    $message['code'] = 0;
 	}
 	else{
    	$message['valid'] = 0;
    	$message['code'] = 200;
   	}
   	echo json_encode($message);//返回二维数组形式的值供小程序端用
}
?>
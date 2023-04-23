<?php
//header("Content-type: text/html; charset=utf8");
include 'connect.php';     //调用connect.php文件
$table=$_GET['table'];     //需要查询的表
$fields=$_GET['fields'];    //需要查询的字段
$conditions=$_GET['conditions'];    //查询的条件

if ($con->connect_error) {
	die("连接失败：".$con->connect_error);
}
else 
{

 	$sql="SELECT ".$fields." FROM ".$table." WHERE ".$conditions;//根据传入的参数查询数据库中的数据
 	$res=$con->query($sql);
 	if ($res){
 		$message['data']=$res->fetch_all(MYSQLI_ASSOC);
 	}
 	else{
    	$message['data']='查询出错！';
   	 }
   	 echo json_encode($message);//返回二维数组形式的值供小程序端用
}
?>
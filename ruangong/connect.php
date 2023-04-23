<?php
//header("Content-type: text/html; charset=utf8");
//1. 声明字符编码
 
$host='localhost';//数据库ip
 
$user='ruangong6';//用户名
 
$password='RuanGong6666';//密码
 
$dbName='ruangong6';//要连接的数据库名
 
$conStr = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $host, $dbName);

$pdo = new PDO($conStr, $user, $password);

$message=array();
 
 
if ($pdo->connect_error) {
    $message["msg"]="系统异常，连接数据库失败";
}
else
{
	$message["msg"]="连接成功";
}
?>
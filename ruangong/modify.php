<?php
//header("Content-type: text/html; charset=utf8");
include 'connect.php';        //调用connect.php文件
$table=$_GET['table'];        //需要进行操作的表
$fileds=$_GET['fileds'];       //需要进行操作的字段
$values=$_GET['values'];    //插入的数据
$kvs=$_GET['kvs'];             //需要更新的字段
$conditions=$_GET['conditions'];    //查询的条件
$type=$_GET['type']  //操作类型

if ($con->connect_error) {
	die("连接失败：".$con->connect_error);
}
else 
{
	if(strcmp($type,  'insert') == 0){
 		$sql="INSERT INTO ".$table."(".$fileds.") VALUES (".$values.")";
	elseif(strcmp($type,  'update') == 0){
		$sql="UPDATE ".$table." SET ".$kvs." WHERE ".$conditions;
	}else{
		$sql="DELETE FROM ".$table." WHERE ".$conditions;
	}
 	$res=$con->query($sql);
 	if($res){
		$arr['status'] = 1;
		$arr['info'] = 'success';
	}else{
		$arr['status'] = 0;
		$arr['info'] = 'error';
	}
	echo json_encode($arr);
	die;
}
?>
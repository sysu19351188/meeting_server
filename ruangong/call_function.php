<?php
header("Access-Control-Allow-Origin:*");
include 'connect.php';     //调用connect.php文件
$func=$_GET['func'];     //需要调用的函数
$para=$_GET['para'];    //需要传入的参数

if ($pdo->connect_error) {
	die("连接失败：".$con->connect_error);
}
else 
{

 	$sql="CALL ".$func."(".$para.")";//根据传入的参数查询数据库中的数据
 	$res=$pdo->query($sql);
 	if ($res){
 	    $message['valid'] = 1;
 	    $message['code'] = 0;
 	    if(is_bool($res)){
 		    $message['data']='更新成功';
 	    }else{
 	        if($func == "show_meetingrooms" || $func == "show_meetingroom"){
 	            $message['data']=$res->fetchAll(PDO::FETCH_ASSOC);
 	            $num = 0;
                while($num < count($message['data'])){
                    $message['data'][$num] = $message['data'][$num]['image'];
                    $num = $num + 1; 
                }
 	            header("Content-Type: image/jpg");
 	            echo $message['data'][0];
 	            exit;
 	        }else{
 	            $message['data']=$res->fetchAll(PDO::FETCH_ASSOC);
 	        }
 	    }
 	}
 	else{
    	$message['valid'] = 0;
    	$message['code'] = 200;
   	}
   	//$pdo = null;
   	echo json_encode($message);//返回二维数组形式的值供小程序端用
}
?>
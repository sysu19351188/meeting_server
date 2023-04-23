<?php
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
 	    $message['status'] = 1;
 	    if(is_bool($res)){
 		    $message['data']='更新成功';
 	    }else{
 	        if($func == "show_meetingrooms__img" || $func == "show_meetingroom__img"){
 	            $res->bindColumn(1, $img, PDO::PARAM_LOB);
 	            $imgs = array();
 	            $t = array();
 	            $num = 0;
                while($res->fetch(PDO::FETCH_BOUND)){
                    $imgs[$num] = $img;
                    $t[$num]=base64_encode($imgs[$num]);
                    $num = $num + 1; 
                }
 	            $test = '1ds';
 	            $message['data']['image'] = $t;
 	            echo $t[0];
 	            echo "<br />";
 	            echo json_encode($message);
 	            exit;
 	        }else{
 	            $message['data']=$res->fetchAll(PDO::FETCH_ASSOC);
 	        }
 	    }
 	}
 	else{
    	$message['status'] = 0;
   	}
   	$pdo = null;
   	echo json_encode($message);//返回二维数组形式的值供小程序端用
}
?>
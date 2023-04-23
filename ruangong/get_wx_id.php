<?php
function geturl($url){//geturl函数

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);

curl_close($ch);

return $output;

}

$appid=$_GET["appid"];

$secret=$_GET["secret"];//小程序appid与secret配置

if(isset($_GET["code"])&&$_GET["code"]<>""){

$js_code=$_GET["code"];

}else{

die("ERROR");

}//获得js_code

$url="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$js_code."&grant_type=authorization_code";

$tmpstr=geturl($url);

echo $tmpstr;//输出数据以供小程序端获得
?>
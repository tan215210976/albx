<?php 
//查询当前登录的这个用户的头像和名称信息

session_start();
$userId=$_SESSION["userId"];
//定义一个查询头像信息和名称信息的sql语句
$sql="select avatar,nickname from users where id={$userId}";
include_once "../../functions.php";
$arr=query($sql);
if(empty($arr)){
	$res=["code"=>404,"msg"=>'查询失败'];
}else{
	$res=["code"=>200,"msg"=>'查询成功','data'=>$arr];
}
echo json_encode($res);
 ?>


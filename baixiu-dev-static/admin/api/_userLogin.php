<?php 
//前端会发送email账号和密码过来，后台接收前端发送的数据
$email=$_POST['email'];
$password=$_POST['password'];
$sql="select * from users where email='{$email}' and password='{$password}' and status='activated'";
include_once '../../functions.php';
$result=query($sql);
if(empty($result)){
	$res=['code'=>233,'msg'=>'您输入的密码有误'];
}else{
    $res=['code'=>200,'msg'=>'登录成功'];
    session_start();
    $_SESSION['isLogin']='true';
    $_SESSION['userId']=$result[0]['id'];
}
echo json_encode($res);

 ?>
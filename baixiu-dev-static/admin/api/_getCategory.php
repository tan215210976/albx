<?php 
$sql="select * from categories";
include_once "../../functions.php";
$arr=query($sql);
if(empty($arr)){
	$res=["code"=>403,"msg"=>"查询分类失败"];
}else{
	$res=["code"=>200,"msg"=>"查询成功","data"=>$arr];
}
echo json_encode($res);


 ?>
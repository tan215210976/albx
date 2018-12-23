<?php
	//接收前端发送过来的要删除的分类的id数组
	$ids = $_POST["ids"];

	$str = implode(",", $ids );

	$sql = " delete from categories where id in ({$str})  ";


	include "../../functions.php";

	$result = execute($sql);

	if($result === true){
		$res = ["code"=>200 , "msg"=>"批量删除成功"];
	}else{
		$res = ["code"=>233 , "msg"=>"批量删除失败".$result];
	}

	echo json_encode($res);

?>
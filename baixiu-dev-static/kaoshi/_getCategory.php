<?php
	//sql语句
	$sql = " select * from categories ";
	//包含functions.php
	include_once "../functions.php";
	//执行sql语句并得到查询结果数组
	$arr = query($sql);
	//判断数组中是否有数据
	if(empty($arr)){
		$res = [ "code"=>403 , "msg"=>"查询分类失败" ];
	}else{
		$res = [ "code"=>200 , "msg"=>"查询成功", "data"=>$arr ];
	}

	//将数组转换为json格式的字符串并输出
	echo json_encode($res);

?>
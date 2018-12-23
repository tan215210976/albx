<?php 
	//要求前端发送参数信息：页码，每页的数据量，状态，分类
	$page = $_POST["page"];
	$pageSize = $_POST["pageSize"];
	$status = $_POST["status"]; //如果前端发送的status参数的值为“all”,则代表要查询所有状态
	$categoryId = $_POST["categoryId"];//如果前端发送的categoryId参数的值为“all”,则代表要查询所有分类

	$sql = " select posts.id,posts.title,users.nickname,categories.name,posts.created,posts.status from posts
		inner join categories on categories.id = posts.category_id
		inner join users on users.id = posts.user_id 
		where 1=1 ";

	if($status != "all"){
		$sql = $sql . " and posts.status = '{$status}' ";
	}

	if($categoryId != "all"){
		$sql = $sql . " and posts.category_id = '{$categoryId}' ";
	}

	$offset = ($page - 1) * $pageSize;

	$sql = $sql . " limit {$offset},{$pageSize} ";

	include "../../functions.php";

	$result = query($sql);


	//获取查询结果的条数
	$sql = " select count(posts.id) as postCount from posts
		inner join categories on categories.id = posts.category_id
		inner join users on users.id = posts.user_id 
		where 1=1 ";

	if($status != "all"){
		$sql = $sql . " and posts.status = '{$status}' ";
	}

	if($categoryId != "all"){
		$sql = $sql . " and posts.category_id = '{$categoryId}' ";
	}

	$offset = ($page - 1) * $pageSize;

	// $sql = $sql . " limit {$offset},{$pageSize} ";

	// echo $sql;
	$countResult = query($sql);

	// var_dump($sql);
	//计算出一共有多少页
	if( !(empty($countResult)) )
	{
		$totalPage = ceil($countResult[0]["postCount"] / $pageSize);
	}

	if( empty($result) ){
		$res = ["code"=>233,"msg"=>"没有查询到文章信息"];
	}else{
		$res = ["code"=>200,"msg"=>"查询成功" , "data"=>$result , "page"=>$page,"pageSize"=>$pageSize,"totalPage"=>$totalPage ];
	}

	echo json_encode($res);


 ?>

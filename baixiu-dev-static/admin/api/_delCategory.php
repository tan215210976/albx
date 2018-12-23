<?php 
    $categoryId=$_POST['categoryId'];
    include_once "../../functions.php";
    $sql="delete from categories where id={$categoryId}";
    $result=execute($sql);
    if($result==true){
    	$res=['code'=>200,"msg"=>"删除成功"];
    }else{
    	$res=['code'=>233,"msg"=>"删除失败,".$result];
    }

    echo json_encode($res);

 ?>
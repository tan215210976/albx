<?php 
     //接收参数
//根据id来修改
$categoryId=$_POST["categoryId"];
     $name=$_POST["name"];
     $slug=$_POST["slug"];
     $classname=$_POST["classname"];
     $sql="update categories set name='{$name}',slug='{$slug}',classname='{$classname}' where id={$categoryId}";
     include_once "../../functions.php";
     $result=execute($sql);
     if($result===true){
     	$res=["code"=>200,"msg"=>"更新成功"];
     }else{
     	$res=["code"=>233,"msg"=>"更新失败,".$result];
     }
      echo json_encode($res);	

 ?>
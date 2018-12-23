<?php 
  $name=$_POST["name"];
  $slug=$_POST["slug"];
  $classname=$_POST["classname"];
  $sql="select * from categories where name='{$name}'";
  include_once "../../functions.php";
  $arr=query($sql);
  if(empty($arr)){
        $sql="insert into categories values(null,'{$slug}','{$name}','{$classname}')";
        $result=execute($sql);
        if($result===true){
        	$res=["code"=>200,"msg"=>"添加成功"];
        }else{
$res=["code"=>234,"msg"=>"添加失败"];
        }
  }else{
  	$res=["code"=>233,"msg"=>"有同名的分类，无法添加"];

  }
echo json_encode($res);

 ?>
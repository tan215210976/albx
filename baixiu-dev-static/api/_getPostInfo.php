<?php 

  $postId=$_POST["postId"];
  $sql = " select posts.title,content,created,views,likes,users.nickname,categories.name 
  from posts 
  inner join categories on posts.category_id = categories.id
  inner join users on posts.user_id = users.id
  where categories.id != 1 and posts.id = {$postId} ";
  include_once '../functions.php';
 $postArr=query($sql);
 if(empty($postArr)){
$res=["code"=>404,"msg"=>"没有查询到编号对应的文章"];
 }else{
$res=["code"=>200,"msg"=>"查询成功","data"=>$postArr];
 }
 echo json_encode($res);
?>
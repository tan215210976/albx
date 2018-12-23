<?php 
    $page=$_POST["page"];
    $pageSize=$_POST["pageSize"];
    $offset=($page-1)*$pageSize;
    $sql="select comments.author,comments.content,comments.created,comments.status,posts.title from comments left join posts on posts.id=comments.post_id limit {$offset},{$pageSize}";
    include_once "../../functions.php";
    $result=query($sql);
    $sql2="select count(posts.id) as postCount,comments.author,comments.content,comments.created,comments.status,posts.title from comments left join posts on posts.id=comments.post_id ";
    $result2=query($sql2);
    if( !(empty($result2)) ){
    $totalpage=ceil($result2[0]["postCount"]/$pageSize);
    }
    if(empty($result)){
        $res=["code"=>233,"msg"=>"没有查询到评论数据"];
    }else{
$res=["code"=>200,"msg"=>"查询成功","data"=>$result,"totalpage"=>$totalpage];
    }

  echo json_encode($res);


 ?>
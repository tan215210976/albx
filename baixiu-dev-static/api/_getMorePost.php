<?php 
    $categoryId=$_GET['categoryId'];
    $page=$_GET['page'];
    $pageSize=$_GET['pageSize'];
    $offset=($page-1)*$pageSize;
    $sql="select posts.id, posts.title,content,created,views,likes,users.nickname,categories.name ,posts.feature,
(select count(*) from comments where post_id = posts.id)as commentsCount
from posts 
inner join categories on posts.category_id = categories.id
inner join users on posts.user_id = users.id
where categories.id != 1 and categories.id = {$categoryId}
order by created desc
limit $offset,$pageSize";
 include_once '../functions.php';
$getarr=query($sql);
echo  json_encode($getarr);
 ?>

 
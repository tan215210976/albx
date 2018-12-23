
<?php 
//获取地址栏中id的值
 $id=$_GET['id'];
 //连接数据库
 $conn=mysqli_connect('127.0.0.1','root','root','db_baixiu');
 if(!$conn){
  die("数据库连接失败");
 }
 $sql="select posts.id, posts.title,content,created,views,likes,users.nickname,categories.name ,posts.feature,
(select count(*) from comments where post_id = posts.id)as commentsCount
from posts 
inner join categories on posts.category_id = categories.id
inner join users on posts.user_id = users.id
where categories.id != 1 and categories.id = {$id}
order by created desc
limit 10";
//执行数据库语句
$result=mysqli_query($conn,$sql);
$listArr=[];
//循环遍历
while ($row=mysqli_fetch_assoc($result)) {
 $listArr[]=$row;//添加到数组
}
// print_r($listArr);


 ?>
 <!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="static/assets/css/style.css">
  <link rel="stylesheet" href="static/assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
     <?php include_once'public/_header.php' ?>
    <?php include_once'public/_aside.php' ?>
    <div class="content">
      <div class="panel new">
        <h3><?php 
        if(empty($listArr)){
          //判断里面的文章是否为空
          echo "当前分类没有文章";  
          }else{
            //如果不为空，那么就获取文章数组中第一篇文章的分类名字
            echo $listArr[0]['name'];
            } ?></h3>
        <?php 
        foreach ($listArr as $v) { ?>
          <div class="entry">
          <div class="head">
            <a href="detail.php?postId=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $v['nickname'] ?> <?php echo $v['created'] ?></p>
            <p class="brief"><?php echo $v['content'] ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $v['views'] ?>)</span>
              <span class="comment">评论(<?php echo $v['commentsCount'] ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $v['likes'] ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $v['name'] ?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?php echo $v["feature"]; ?>" alt="">
            </a>
          </div>
        </div>
       <?php }
         ?>
        <div class="loadmore">
          <span class="btn">加载更多</span>
        </div>
        
      
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src="./static/assets/vendors/jquery/jquery.js"></script>
  <script src="./static/assets/vendors/nprogress/nprogress.js"></script>
  <script src="./static/assets/vendors/art-template/template-web.js"></script>
  <script type="text/template" id="list">
    {{each  items as value index}}
 <div class="entry">
          <div class="head">
            <a href="detail.php?postId={{value.id}}">{{ value.title }}</a>
          </div>
          <div class="main">
            <p class="info">{{value.nickname}} {{ value.created}}</p>
            <p class="brief">{{ value.content}}</p>
            <p class="extra">
              <span class="reading">阅读({{value.views}})</span>
              <span class="comment">评论({{value.commentsCount}})</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞({{value.likes}})</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>{{value.name}}</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="{{value.feature}}" alt="">
            </a>
          </div>
        </div>
{{/each}}
  </script>
  <script>
    $(function(){
      var page=1;
          $('.loadmore .btn').on('click',function(){
             page=page+1;
             var x=new URLSearchParams(location.search);
             var categoryId=x.get('id');
              $.ajax({
                url:'api/_getMorePost.php',
                data:{categoryId:categoryId,page:page,pageSize:10},
                dataType:'json',
                success:function(res){
    
                  var html=template('list',{ items:res});
                  $('.loadmore').before(html);
                  //如果没有数据就不要传输数据
                  if(res.length==0){
                    $('.loadmore .btn').off('click').html('没有更多内容了')
                  }

                }
              });
            
          })
    });
  </script>
</body>
</html>
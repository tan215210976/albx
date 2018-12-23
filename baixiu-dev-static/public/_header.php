<?php 
    //1.连接数据库
$conn=mysqli_connect('127.0.0.1','root','root','db_baixiu');
if(!$conn){
  die('数据库连接失败');
}
//2.定义sql语句
$sql="select * from categories where id!=1";

//3.执行sql语句，查询导航分类信息
$result=mysqli_query($conn,$sql);
//4.读取所有分类数据保存到一个数组中
$arr=[];
//5.循环数组生成导航
while ($row=mysqli_fetch_assoc($result)) {
  $arr[]=$row;
}
 ?>

<div class="header">
      <h1 class="logo"><a href="index.php"><img src="static/assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
       <?php foreach ($arr as  $value) {?>
         
       <li><a href="list.php?id=<?php echo $value['id'] ?>"><i class="fa <?php echo $value['classname'] ?>"></i><?php echo $value['name'] ?></a></li> 
       <?php } ?>
        
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
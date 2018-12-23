<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.php"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger"style="display:none" >
        <strong>错误！</strong><span id="msg">发生XXX错误</span>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
             <div class="form-group">
              <label for="classname">类名</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="类名">
              <p class="help-block">https://zce.me/category/<strong>类名</strong></p>
            </div>
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
            <span id="btn_add" class="btn btn-primary">添加</span>
            <span id="btn_edit" style="display: none;" class="btn btn-primary">编辑完成</span>
            <span id="btn_cancel" style="display: none;" class="btn btn-primary">取消编辑</span>
            

            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a  id='delall' class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
            
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <div class="profile">
      <img class="avatar" src="../static/uploads/avatar.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li>
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li class="active">
        <a href="#menu-posts" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse in">
          <li><a href="posts.php">所有文章</a></li>
          <li><a href="post-add.php">写文章</a></li>
          <li class="active"><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.php">导航菜单</a></li>
          <li><a href="slides.php">图片轮播</a></li>
          <li><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>

   <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../static/assets/vendors/art-template/template-web.js"></script>
  <script type='text/template' id="temp">
  <% for (var items of data ){%>
              <tr  data-id="<%=items.id%>">
                <td class="text-center"><input type="checkbox"></td>
                <td><%=items.name%></td>
                <td><%=items.slug%></td>
                  <td><%=items.classname%></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs edit">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs del">删除</a>
                </td>
              </tr>
<% }%>
  </script>
  <script>NProgress.done()</script>
  <script>
    $(function () {
          var  categoryId=null;
           $.ajax({
              dataType:'json',
              url:'api/_getUserAvater.php',
              success:function(res){
                    $('.aside .profile .avatar').attr('src',res.data[0].avatar);
                    $('.aside .profile .name').html(res.data[0].nickname);
              }
           });

           $.ajax({
            url:'api/_getCategory.php',
            type:'post',
            dataType:'json',
            success:function(res){
                
                var html=template('temp',res);
                
                $("tbody").html(html);
            }
           });
           $('#btn_add').on('click',function(){
                    var name=$('#name').val();
                    var slug=$('#slug').val();
                    var classname=$('#classname').val();
                    if(name.trim()==''){
                      $('.alert').show().find('#msg').text('请输入分类名称');
                      return;
                    }else if(slug.trim()==''){
                      $('.alert').show().find('#msg').text('请输入分类别名');
                           return;
                    }else if(classname.trim()==''){
                       $('.alert').show().find('#msg').text('请输入分类图标类名');
                            return;
                    };
                    $.ajax({
                       url:'api/_addCategory.php',
                       type:'post',
                       data:{'name':name,"slug":slug,"classname":classname},
                       dataType:'json',
                       success:function(res){
                        console.log(res);
                         if(res.code!='200'){
                             $('.alert').show().find('#msg').text(res.msg);
                         }else{
                          location.reload();
                         }
                       }
                    });
           });

           //修改获取数据
           $('table').on('click','.edit',function(){

              $("#btn_add").hide();
              $("#btn_edit").show();
              $("#btn_cancel").show();
              var tr=$(this).parents('tr');
              categoryId=tr.attr('data-id');
              var name=tr.find('td').eq(1).text();
               var slug=tr.find('td').eq(2).text();   
               var classname=tr.find('td').eq(3).text();
              $('#name').val(name);
              $('#slug').val(slug);
              $('#classname').val(classname);
           });
           //关闭修改
           $("#btn_cancel").on('click',function(){
              $("#btn_add").show();
              $("#btn_edit").hide();
              $("#btn_cancel").hide();

              $('#name').val('');
              $('#slug').val('');
              $('#classname').val('');
           });
           //修改
           $('#btn_edit').on('click',function(){
              var name=$('#name').val();
              var slug=$('#slug').val();
              var classname=$('#classname').val();
              $.ajax({
            url:'api/_updateCategory.php',
            type:'post',
            data:{'name':name,"slug":slug,"classname":classname,"categoryId":categoryId},
            dataType:'json',
            success:function(res){
              console.log(res);
                  if(res.code==200){
                    location.reload();
                  }else{
                    $('.alert').show().find('#msg').text(res.msg);
                  }
            }


              });
           });
           //删除功能
            $('table').on('click','.del',function(){
              var tr=$(this).parents('tr');
              categoryId=tr.attr('data-id');
              $.ajax({
                url:'api/_delCategory.php',
                type:'post',
                data:{'categoryId':categoryId},
                dataType:'json',
                success:function(res){
                   if(res.code==200){
                    location.reload();
                  }else{
                    $('.alert').show().find('#msg').text(res.msg);
                  }
                }
              })

            });
            //全选
            $('thead input').on('click',function(){
                $('tbody input').prop('checked',$('thead input').prop('checked'));
                if($('thead input').prop('checked')){
                  $('#delall').show();
                }else{
                   $('#delall').hide();
                }
            });
            $('tbody').on('click','input',function(){
                var num1=$('tbody input').length;
                var num2=$('tbody input:checked').length;
                // console.log(num1,num2);
                $('thead input').prop('checked',num1==num2);

                if(num2>=2){
                  $('#delall').show();
                }else{
                   $('#delall').hide();
                }
            });
            $('#delall').on('click',function(){
                var cks=$('tbody input:checked');
                var ids=[];
                for(var i=0;i<cks.length;i++){
                 var id=$(cks[i]).parents('tr').attr('data-id');
                  ids.push(id);
                }
                //发送ajax进行批量删除
                $.ajax({
                  url:'api/_delAllCategory.php',
                  data:{ids:ids},
                  dataType:'json',
                  type:'post',
                  success:function(res){
                    console.log(res);
                        if(res.code==200){
                    location.reload();
                  }else{
                    $('.alert').show().find('#msg').text(res.msg);
                  }
                  }
                })
            });

    })
  </script>
</body>
</html>

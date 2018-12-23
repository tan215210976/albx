<?php 
$ext=strrchr($_FILES['upload']['name'], '.');
$filename=time().rand(1000,9999).$ext;
$result=move_uploaded_file($_FILES['upload']['tmp_name'], "../../static/uploads/{$filename}");
if($result){
	$res=["code"=>200,'msg'=>"图片上传成功","imgSrc"=>"../static/uploads/{$filename}"];
}else{
	$res=["code"=>233,'msg'=>"图片上传失败"];
}
  echo  json_encode($res);
 ?>
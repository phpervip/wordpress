<?php
header('Access-Control-Allow-Headers:*');
header("Access-Control-Allow-Origin: *");
require('../../../../wp-load.php');
$page=@$_GET['$page'];
$data=[];
$args=array(
	'post_type'=>'post',
	'post_status'=>'publish',
	'posts_per_page'=>10,
	'paged'=>$page,
	'orderby'=>'date',
	'order'=>'DESC'
);
query_posts($args);
if(have_posts()){
	$posts=[];
	while(have_posts()): the_post();
		$post_id=get_the_ID();
		$list=[
			"id"=>$post_id,
			"title"=>get_the_title(),
			"img"=>get_the_post_thumbnail_url()
		];
		array_push($posts,$list);
	endwhile;

	$data['code']=200;
	$data['msg']="查询数据成功!";
	$data['post']=$posts;
}else{
	$data['code']=404;
	$data['msg']="没有相关文章";
	$data['post']=[];
}	
print_r(json_encode($data));
?>


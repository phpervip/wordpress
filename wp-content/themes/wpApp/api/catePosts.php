<?php
// 接口名：获取某分类下文章列表
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("Access-Control-Allow-Origin: *");
//引入WP加载文件，引入之后就可以使用WP的所有函数
require( '../../../../wp-load.php' );
//定义返回数组，默认先为空
$posts=[];
// 1、接收post参数。
$cat_ID = $_GET["cid"];
// 2、得到分类下所有文章 
query_posts('showposts=-1&cat=' . $cat_ID);
if (have_posts()){ //如果查询出来了文章
	// 循环文章数据
	while ( have_posts() ) : the_post();
		// 获取文章id
		$post_id=get_the_ID();
		// 定义单条文章所需要的数据
		$list=[
			"id"	=>$post_id,  //文章id
			"title"	=>get_the_title(), //文章标题
			"img"	=>get_the_post_thumbnail_url() //文章缩略图
		];
		// 将每一条数据分别添加进$posts
		array_push($posts,$list);
	endwhile;
}else {
	// 如果没有文章
	$posts=[];
}
//*********************************返回值***********************************************
$data['posts'] = $posts;
print_r(json_encode($data));
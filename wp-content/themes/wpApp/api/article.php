<?php
// 接口名：文章详情页面
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("Access-Control-Allow-Origin: *");
//引入WP加载文件，引入之后就可以使用WP的所有函数
require( '../../../../wp-load.php' );
//定义返回数组，默认先为空
$data=[];
//1、接收post参数。
$id = $_GET["id"];
$post = get_post( $id ); 
$info['post_content'] 	= $post->post_content;
$info['author'] 		= $post->author;
$info['post_date'] 		= $post->post_date;

$data['code']		= 200;
$data['msg']		= "查询数据成功！";
$data['post_info']	= $info;
// 输出json数据格式
print_r(json_encode($data));
?>

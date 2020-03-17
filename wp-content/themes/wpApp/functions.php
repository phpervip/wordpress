<?php
//开启编辑缩略图
add_theme_support('post-thumbnails');

//允许中文名
function allowed_chinese_name ($username, $raw_username, $strict) {
  $username = wp_strip_all_tags( $raw_username );
  $username = remove_accents( $username );
  $username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
  $username = preg_replace( '/&.+?;/', '', $username ); 
  if ($strict) {
    $username = preg_replace ('|[^a-zp{Han}0-9 _.-@]|iu', '', $username);
  }
  $username = trim( $username );
  $username = preg_replace( '|s+|', ' ', $username );
  return $username;
}
add_filter ('sanitize_user', 'allowed_chinese_name', 10, 3);
function jinsom_update_user_login($user_id,$user_login){
global $wpdb;
if($wpdb->query( "UPDATE $wpdb->users SET user_login = '$user_login' WHERE ID=$user_id;" ))
return 1;
return 0;
}
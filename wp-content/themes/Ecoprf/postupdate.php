<?php
  require_once( dirname(__FILE__) . '/wp-load.php' );
  require_once( dirname(__FILE__) . '/wp-admin/includes/admin.php');

$posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'any']);


foreach($posts as $post){


      add_post_meta($post->ID, 'rtng', '100', true);


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
  require_once( dirname(__FILE__) . '/wp-load.php' );
  require_once( dirname(__FILE__) . '/wp-admin/includes/admin.php');

  // $post = get_category( 24 );
  // print_r( $post );
  // echo 1234;
  // $fields =  get_term_meta( 24 );
  // print_r( $fields );




?>
<!-- <?php tablepress_print_table_info( "id=125&field=name" ); ?> -->

<?php
global $post; // не обязательно

// 5 записей из рубрики 9
$myposts = get_posts( array(
	'post_type' => 'tablepress_table',
  'posts_per_page' => 1,
  // 'include' => 125,
) );

foreach( $myposts as $post ){
	setup_postdata( $post );
  print_r($post);
}

wp_reset_postdata(); // сбрасываем переменную $post
?>
</body>
</html>


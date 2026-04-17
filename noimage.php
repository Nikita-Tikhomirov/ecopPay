<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/wp-load.php';

echo "<pre>";

$posts = get_posts([
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => 'kartinka_kursa',
            'compare' => 'EXISTS',
        ],
    ],
    'fields' => 'ids',
]);

$broken = [];

foreach ($posts as $post_id) {
    $image_id = get_field('kartinka_kursa', $post_id, false); // получаем ID вложения как есть
    if ($image_id && !get_post($image_id)) {
        $title = get_the_title($post_id);
        $url   = get_permalink($post_id);
        $broken[] = [
            'ID'    => $post_id,
            'title' => $title,
            'url'   => $url,
        ];
    }
}

echo "Постов с битой картинкой: " . count($broken) . "\n\n";

foreach ($broken as $post) {
    echo "{$post['ID']}, ";
}

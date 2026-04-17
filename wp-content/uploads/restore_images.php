<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre>";

// === 1. Подключаем текущий WordPress ===
require_once __DIR__ . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

// === 2. Подключаем СТАРУЮ базу ТОЛЬКО на чтение ===
$old_db = new wpdb('ecoprf_restore', '%0XupO3EJSkD', 'ecoprf_restore', 'ecoprf.beget.tech');
$old_db->show_errors();

// === 3. Список постов с битой картинкой ===
// если есть файл missing_ids.txt с выводом — можно читать его
$broken_posts = [9038, 9029, 8992, 8985, 8571, 8567, 8559, 8555, 8551, 8547, 8539, 8535, 8531, 8527, 8523, 8519, 8515, 8511, 8507, 8503, 8499, 8495, 8491, 8487, 8483, 8479, 8475, 8471, 8467, 8463, 8459, 8443, 8439, 8435, 8431, 8427, 8422, 8417, 8409, 8175, 8170, 8165, 8161, 8151, 8147, 8143, 8139, 8135, 8131, 8118, 8114, 8110, 8102, 8098, 8093, 8089, 8084, 8080, 8075, 8070, 8052, 8048, 8044, 8040, 8025, 8016, 8008, 8004, 8000, 7996, 7992, 7988, 7984, 7978, 7689, 7685, 7677, 7673, 7669, 7665, 7661, 7656, 7652, 7644, 7640, 7636, 7632, 7628, 7624, 7618, 7610, 7606, 7595, 7591, 7587, 7583, 7578, 7574, 7570, 7565, 7561, 7557, 7552, 7548, 7540, 7536, 7532, 7528, 7524, 7520, 7516, 7511, 7502, 7498, 7491, 7487, 7456, 7427, 7419, 7415, 7411, 7407, 7403, 7398, 7394, 7388, 7384, 7380, 7376, 7370, 7365, 7360, 7355, 7349, 7340, 7336, 7332, 7326, 7320, 7253, 7290, 7285, 7279, 7261, 7246, 7236, 7211, 7195, 7186, 7273, 7155, 7149, 7141, 7132, 6652, 6647, 6643, 6637, 6633, 6628, 6624, 6620, 6611, 6607, 6603, 6598, 6591, 6587, 6582, 6578, 6574, 6568, 6562, 6557, 6552, 6547, 6541, 6534, 6528, 6524, 6519, 6514, 6510, 6503, 6498, 6494, 6488, 6476, 6468, 6443, 6452, 6441, 6436, 6430, 6425, 6421, 6417, 6411, 6387, 6383, 6374, 6375, 6370, 6366, 6362, 6358, 6354, 6351, 6346, 6342, 6335, 6330, 6325, 6319, 6311, 6296, 6140, 6117, 6109, 6096, 6020, 6014, 6004, 5991, 5988, 5904, 4741, 4660, 4654, 4643, 4633, 4537, 4520, 4459, 4453, 4447, 4441, 4432, 4426, 4420, 4334, 4233, 4217, 4186, 4171, 4160, 4050, 4043, 4031, 4022, 3843, 3802, 3796, 3736, 3647, 3524, 3514, 3505, 3441, 3431, 3035, 2923, 2817, 2781, 2768, 2749, 2697, 2677, 1983, 1948, 1937, 1905, 1897, 1840, 1688, 1683, 1678, 1669, 1656, 1651, 1550, 1515, 1472, 1366, 1302, 1284, 1252, 1176, 1170, 817, 1059, 1038, 1012, 1009, 1004, 1001, 995, 986, 969, 966, 962, 837, 827, 824, 822, 820, 815, 809, 789, 787, 548, 525, 433, 411, 121, 110, 103, 90, 48,];

echo "Всего битых постов: " . count($broken_posts) . "\n\n";

foreach ($broken_posts as $post_id) {
    // 3.1 получаем из старой БД ID вложения, хранившийся в kartinka_kursa
    $old_attachment_id = $old_db->get_var( $old_db->prepare(
        "SELECT meta_value FROM {$old_db->prefix}postmeta
         WHERE post_id = %d AND meta_key = %s",
        $post_id, 'kartinka_kursa'
    ));

    if (!$old_attachment_id) {
        echo "⛔ Нет attachment ID в старой базе для поста $post_id\n";
        continue;
    }

    // 3.2 берём сам attachment‑пост из старой БД
    $old_attachment = $old_db->get_row( $old_db->prepare(
        "SELECT * FROM {$old_db->prefix}posts
         WHERE ID = %d AND post_type = 'attachment'",
        $old_attachment_id
    ) );

    if (!$old_attachment) {
        echo "⛔ В старой базе нет записи attachment ID $old_attachment_id\n";
        continue;
    }

    // 3.3 путь к файлу (guid старой БД) → превращаем в абсолютный
    $uploads = wp_upload_dir();
    $relative_path = str_replace( $uploads['base_url'], '', $old_attachment->guid );
    $file_path     = $uploads['basedir'] . $relative_path;

    if (!file_exists($file_path)) {
        echo "⛔ Файла нет на диске: $file_path (пост $post_id)\n";
        continue;
    }

    // 3.4 создаём новый attachment в текущей БД
    $attachment = [
        'post_mime_type' => $old_attachment->post_mime_type,
        'post_title'     => $old_attachment->post_title ?: basename($file_path),
        'post_content'   => '',
        'post_status'    => 'inherit',
    ];
    $new_attach_id = wp_insert_attachment($attachment, $file_path, $post_id);

    if (is_wp_error($new_attach_id)) {
        echo "❌ Не удалось создать attachment для поста $post_id\n";
        continue;
    }

    // 3.5 метаданные (миниатюры и т.д.)
    $meta = wp_generate_attachment_metadata($new_attach_id, $file_path);
    wp_update_attachment_metadata($new_attach_id, $meta);

    // 3.6 записываем в ACF
    update_field('kartinka_kursa', $new_attach_id, $post_id);

    echo "✅ Восстановлено изображение у поста $post_id (attachment $new_attach_id)\n";
}

echo "\nГотово.\n";

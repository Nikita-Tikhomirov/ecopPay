<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre>";

// Подключение WP-функций
require_once __DIR__ . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

// Подключение PHPWord
require_once __DIR__ . '/wp-content/themes/Ecoprf/libs/phpword/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;

// Функция транслитерации
function translit($text)
{
    $text = mb_strtolower(trim($text), 'UTF-8');
    $text = strtr($text, [
        'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'zh','з'=>'z','и'=>'i','й'=>'y','к'=>'k',
        'л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'ts',
        'ч'=>'ch','ш'=>'sh','щ'=>'sch','ь'=>'','ы'=>'y','ъ'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
        ' ' => '-', '—' => '-', '_' => '-', '«' => '', '»' => '', '"' => '', "'" => '', ',' => ''
    ]);
    $text = preg_replace('/[^a-z0-9\-]+/', '', $text); // удаляем всё кроме латиницы, цифр и дефиса
    $text = trim($text, '-'); // удаляем крайние дефисы
    if (empty($text)) {
        $text = 'file_' . time(); // запасной вариант
    }
    return $text;
}

// Путь до шаблона
$templatePath = __DIR__ . '/wp-content/themes/Ecoprf/templates/yul.docx';
if (!file_exists($templatePath)) {
    exit("❌ Шаблон не найден: $templatePath\n");
}

// Получаем все курсы
$courses = get_posts([
    'post_type' => 'post',
    'posts_per_page' => -1,
]);

if (empty($courses)) {
    exit("❌ Курсы не найдены\n");
}

echo "Найдено курсов: " . count($courses) . "\n";

foreach ($courses as $course) {
    try {
        $title = get_the_title($course->ID);
        $duration = get_field('prodolzhitelnost', $course->ID) ?: '—';
        $slug = translit($title);

        echo "\nКурс: $title\n";

        $processor = new TemplateProcessor($templatePath);
        $processor->setValue('course_title', $title);
        $processor->setValue('course_time', $duration);

        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['path'] . '/' . $slug . '_ur_new.docx';
        $processor->saveAs($file_path);
        echo "✔️ Сохранено: $file_path\n";

        // Проверяем: есть ли уже файл в поле ACF
        $existing_value = get_field('zayavka_yur_liczo1', $course->ID);

        $existing_id = 0;
        if (is_numeric($existing_value)) {
            $post = get_post((int) $existing_value);
            if ($post && $post->post_type === 'attachment') {
                $existing_id = (int) $existing_value;
            }
        }


        if ($existing_id) {
            update_attached_file($existing_id, $file_path);
            $attach_id = $existing_id;
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            echo "♻️ Обновлён файл и метаданные (ID $attach_id)\n";
        } else {
            // Создаём новый
            $filetype = wp_check_filetype(basename($file_path), null);
            $attachment = [
                'post_mime_type' => $filetype['type'],
                'post_title' => $title,
                'post_content' => '',
                'post_status' => 'inherit',
            ];
            $attach_id = wp_insert_attachment($attachment, $file_path, $course->ID);
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            echo "🆕 Загружен новый файл в медиабиблиотеку (ID $attach_id)\n";
        }

        // Получаем URL и сохраняем в ACF
        $new_url = wp_get_attachment_url($attach_id);

        echo "➡️ Пишем в ACF поле zayavka_yur_liczo1\n";
        echo "Пост ID: {$course->ID}\n";
        echo "Пост title: {$title}\n";
        echo "Тип поста: " . get_post_type($course->ID) . "\n";
        echo "URL: $new_url\n";

        // Пробуем записать
        $success = update_field('zayavka_yur_liczo1', $attach_id, $course->ID);

        if ($success) {
            echo "✅ ACF поле zayavka_yur_liczo1 успешно обновлено\n";
        } else {
            echo "❌ НЕ удалось обновить ACF поле zayavka_yur_liczo1\n";

            // Смотрим, что вообще вернёт get_field
            $check = get_field('zayavka_yur_liczo1', $course->ID);
            echo "🔍 get_field('zayavka_yur_liczo1') сейчас возвращает: ";
            var_dump($check);

            // Есть ли поле вообще?
            global $wpdb;
            $meta = $wpdb->get_row($wpdb->prepare(
                "SELECT meta_key, meta_value FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key = %s",
                $course->ID,
                'zayavka_yur_liczo1'
            ));
            echo "📦 Сырые данные из postmeta:\n";
            var_dump($meta);
        }

    } catch (Throwable $e) {
        echo "❌ Ошибка: " . $e->getMessage() . "\n";
    }
}

echo "\nГотово.\n";

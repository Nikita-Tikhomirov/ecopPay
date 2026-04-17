<?php
/**
 * XML-RPC protocol support for WordPress
 *
 * @package WordPress
 */

/**
 * Whether this is an XML-RPC Request.
 *
 * @var bool
 */


// Discard unneeded cookies sent by some browser-embedded clients.
$_COOKIE = array();

// $HTTP_RAW_POST_DATA was deprecated in PHP 5.6 and removed in PHP 7.0.
// phpcs:disable PHPCompatibility.Variables.RemovedPredefinedGlobalVariables.http_raw_post_dataDeprecatedRemoved
if ( ! isset( $HTTP_RAW_POST_DATA ) ) {
	$HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
}

// Fix for mozBlog and other cases where '<?xml' isn't on the very first line.
if ( isset( $HTTP_RAW_POST_DATA ) ) {
	$HTTP_RAW_POST_DATA = trim( $HTTP_RAW_POST_DATA );
}
// phpcs:enable

/** Include the bootstrap for setting up WordPress environment */
require_once __DIR__ . '/wp-load.php';

function update_all_seo_texts() {
    // Получаем все страницы
    $pages = get_posts(array(
        'posts_per_page' => -1,
        'meta_key' => 'seo_tekst_v_koncze_straniczy',
        'meta_compare' => 'EXISTS'
    ));

    foreach ($pages as $page) {
        // Получаем текущее содержимое поля ACF
        $current_content = get_field('seo_tekst_v_koncze_straniczy', $page->ID);

        if ($current_content) {
            // HTML-контент, который нужно добавить
            $additional_content = '<h2>Как проходит обучение в ЕЦОП</h2>
            <ul>
                <li>1) Выбираете курс (Переходите на страницу курса)</li>
                <li>2) Скачиваете и заполняете заявку, отправляете нам на почту <a href="mailto:info@ecoprf.ru">info@ecoprf.ru</a></li>
                <li>3) Оплачиваете счёт, который мы вам пришлем</li>
                <li>4) Получаете доступ к учебному материалу</li>
                <li>5) Проходите аттестацию</li>
                <li>6) Получаете итоговый документ</li>
            </ul>';

            // Обновляем поле, добавляя новый контент после существующего
            update_field('seo_tekst_v_koncze_straniczy', $current_content . $additional_content, $page->ID);
        }
    }
}

// Запускаем функцию один раз
update_all_seo_texts();

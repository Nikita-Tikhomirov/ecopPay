<?php
register_nav_menus(array(
    'primary' => 'Primary'
));
if (function_exists('register_sidebar')) {
    register_sidebars(1, array('id' => 'copiright', 'name' => 'Copiright', 'description' => '', 'before_widget' => '<div class="widget">', 'after_widget' => '</div>', 'before_title' => '<span class="widget-title">', 'after_title' => '</span>'));

}
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150); // default Post Thumbnail dimensions
}

if (function_exists('add_image_size')) {
    //add_image_size( 'rev_photo', 148, 148, true );
}

function custom_excerpt_more($more)
{
    return ' ...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function custom_excerpt_length($length)
{
    return 60;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function add_theme_scripts()
{
    wp_enqueue_script("jquery");
    wp_enqueue_script('fancyboxj', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), null, true);
    wp_enqueue_script('stacktable', get_template_directory_uri() . '/js/stacktable.js', array('jquery'), null, true);
    wp_enqueue_script('init', get_template_directory_uri() . '/js/init.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function add_theme_style()
{
    wp_enqueue_style('fonts', get_template_directory_uri() . '/css/fonts.css');
    wp_enqueue_style('fancyboxc', get_template_directory_uri() . '/css/jquery.fancybox.css');
    wp_enqueue_style('stacktable', get_template_directory_uri() . '/css/stacktable.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('style2', get_template_directory_uri() . '/css/style2.css');
    wp_enqueue_style('mediaq', get_template_directory_uri() . '/css/media.css');

}
add_action('wp_enqueue_scripts', 'add_theme_style');


add_filter('use_block_editor_for_post', '__return_false');


class My_Walker_Nav_Menu extends Walker_Nav_Menu
{

    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        // создаем HTML код элемента меню
        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}





/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2019.03.03
 * лицензия: MIT
 */
function dimox_breadcrumbs()
{

    /* === ОПЦИИ === */
    $text['home'] = 'Главная'; // текст ссылки "Главная"
    $text['category'] = '%s'; // текст для страницы рубрики
    $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
    $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
    $text['author'] = 'Статьи автора %s'; // текст для страницы автора
    $text['404'] = 'Ошибка 404'; // текст для страницы 404
    $text['page'] = 'Страница %s'; // текст 'Страница N'
    $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

    $wrap_before = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
    $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
    $sep = '<span class="breadcrumbs__separator"> › </span>'; // разделитель между "крошками"
    $before = '<span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
    $after = '</span>'; // тег после текущей "крошки"

    $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $show_last_sep = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
    /* === КОНЕЦ ОПЦИЙ === */

    global $post;
    $home_url = home_url('/');
    $link = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link .= '<meta itemprop="position" content="%3$s" />';
    $link .= '</span>';
    $parent_id = ($post) ? $post->post_parent : '';
    $home_link = sprintf($link, $home_url, $text['home'], 1);

    if (is_home() || is_front_page()) {

        if ($show_on_home)
            echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;

        if ($show_home_link) {
            $position += 1;
            echo $home_link;
        }

        if (is_category()) {
            $parents = get_ancestors(get_query_var('cat'), 'category');
            foreach (array_reverse($parents) as $cat) {
                $position += 1;
                if ($position > 1)
                    echo $sep;
                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
            }
            if (get_query_var('paged')) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) {
                    if ($position >= 1)
                        echo $sep;
                    echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
                } elseif ($show_last_sep)
                    echo $sep;
            }

        } elseif (is_search()) {
            if (get_query_var('paged')) {
                $position += 1;
                if ($show_home_link)
                    echo $sep;
                echo sprintf($link, $home_url . '?s=' . get_search_query(), sprintf($text['search'], get_search_query()), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) {
                    if ($position >= 1)
                        echo $sep;
                    echo $before . sprintf($text['search'], get_search_query()) . $after;
                } elseif ($show_last_sep)
                    echo $sep;
            }

        } elseif (is_year()) {
            if ($show_home_link && $show_current)
                echo $sep;
            if ($show_current)
                echo $before . get_the_time('Y') . $after;
            elseif ($show_home_link && $show_last_sep)
                echo $sep;

        } elseif (is_month()) {
            if ($show_home_link)
                echo $sep;
            $position += 1;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position);
            if ($show_current)
                echo $sep . $before . get_the_time('F') . $after;
            elseif ($show_last_sep)
                echo $sep;

        } elseif (is_day()) {
            if ($show_home_link)
                echo $sep;
            $position += 1;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position) . $sep;
            $position += 1;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'), $position);
            if ($show_current)
                echo $sep . $before . get_the_time('d') . $after;
            elseif ($show_last_sep)
                echo $sep;

        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $position += 1;
                $post_type = get_post_type_object(get_post_type());
                if ($position > 1)
                    echo $sep;
                echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->labels->name, $position);
                if ($show_current)
                    echo $sep . $before . get_the_title() . $after;
                elseif ($show_last_sep)
                    echo $sep;
            } else {
                $cat = get_the_category();
                $catID = $cat[0]->cat_ID;
                $parents = get_ancestors($catID, 'category');
                $parents = array_reverse($parents);
                $parents[] = $catID;
                foreach ($parents as $cat) {
                    $position += 1;
                    if ($position > 1)
                        echo $sep;
                    echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                }
                if (get_query_var('cpage')) {
                    $position += 1;
                    echo $sep . sprintf($link, get_permalink(), get_the_title(), $position);
                    echo $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                } else {
                    if ($show_current)
                        echo $sep . $before . get_the_title() . $after;
                    elseif ($show_last_sep)
                        echo $sep;
                }
            }

        } elseif (is_post_type_archive()) {
            $post_type = get_post_type_object(get_post_type());
            if (get_query_var('paged')) {
                $position += 1;
                if ($position > 1)
                    echo $sep;
                echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label, $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current)
                    echo $sep;
                if ($show_current)
                    echo $before . $post_type->label . $after;
                elseif ($show_home_link && $show_last_sep)
                    echo $sep;
            }

        } elseif (is_attachment()) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID);
            $catID = $cat[0]->cat_ID;
            $parents = get_ancestors($catID, 'category');
            $parents = array_reverse($parents);
            $parents[] = $catID;
            foreach ($parents as $cat) {
                $position += 1;
                if ($position > 1)
                    echo $sep;
                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
            }
            $position += 1;
            echo $sep . sprintf($link, get_permalink($parent), $parent->post_title, $position);
            if ($show_current)
                echo $sep . $before . get_the_title() . $after;
            elseif ($show_last_sep)
                echo $sep;

        } elseif (is_page() && !$parent_id) {
            if ($show_home_link && $show_current)
                echo $sep;
            if ($show_current)
                echo $before . get_the_title() . $after;
            elseif ($show_home_link && $show_last_sep)
                echo $sep;

        } elseif (is_page() && $parent_id) {
            $parents = get_post_ancestors(get_the_ID());
            foreach (array_reverse($parents) as $pageID) {
                $position += 1;
                if ($position > 1)
                    echo $sep;
                echo sprintf($link, get_page_link($pageID), get_the_title($pageID), $position);
            }
            if ($show_current)
                echo $sep . $before . get_the_title() . $after;
            elseif ($show_last_sep)
                echo $sep;

        } elseif (is_tag()) {
            if (get_query_var('paged')) {
                $position += 1;
                $tagID = get_query_var('tag_id');
                echo $sep . sprintf($link, get_tag_link($tagID), single_tag_title('', false), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current)
                    echo $sep;
                if ($show_current)
                    echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
                elseif ($show_home_link && $show_last_sep)
                    echo $sep;
            }

        } elseif (is_author()) {
            $author = get_userdata(get_query_var('author'));
            if (get_query_var('paged')) {
                $position += 1;
                echo $sep . sprintf($link, get_author_posts_url($author->ID), sprintf($text['author'], $author->display_name), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current)
                    echo $sep;
                if ($show_current)
                    echo $before . sprintf($text['author'], $author->display_name) . $after;
                elseif ($show_home_link && $show_last_sep)
                    echo $sep;
            }

        } elseif (is_404()) {
            if ($show_home_link && $show_current)
                echo $sep;
            if ($show_current)
                echo $before . $text['404'] . $after;
            elseif ($show_last_sep)
                echo $sep;

        } elseif (has_post_format() && !is_singular()) {
            if ($show_home_link && $show_current)
                echo $sep;
            echo get_post_format_string(get_post_format());
        }

        echo $wrap_after;

    }
} // end of dimox_breadcrumbs()

add_theme_support('title-tag');

/* Дополнительные сортируемые колонки для постов в админке
------------------------------------------------------------------------ */
// создаем новую колонку
add_filter('manage_post_posts_columns', 'add_views_column', 4);
function add_views_column($columns)
{
    // удаляем колонку Автор
    //unset($columns['author']);

    // вставляем в нужное место - 3 - 3-я колонка
    $out = array();
    foreach ($columns as $col => $name) {
        if (++$i == 6)
            $out['rtng'] = 'Рейтинг';
        $out[$col] = $name;
    }

    return $out;
}
// заполняем колонку данными -  wp-admin/includes/class-wp-posts-list-table.php
add_filter('manage_post_posts_custom_column', 'fill_views_column', 5, 2);
function fill_views_column($colname, $post_id)
{
    if ($colname === 'rtng') {
        echo get_post_meta($post_id, 'rtng', 1);
    }
}

// подправим ширину колонки через css
add_action('admin_head', 'add_views_column_css');
function add_views_column_css()
{
    if (get_current_screen()->base == 'edit')
        echo '<style type="text/css">.column-rtng{width:9%;}.tags,.column-tags{width:5%!important}</style>';
}

// добавляем возможность сортировать колонку
add_filter('manage_edit-post_sortable_columns', 'add_views_sortable_column');
function add_views_sortable_column($sortable_columns)
{
    $sortable_columns['rtng'] = 'rtng_rtng';

    return $sortable_columns;
}

// изменяем запрос при сортировке колонки
add_filter('pre_get_posts', 'add_column_views_request');
function add_column_views_request($object)
{
    if ($object->get('orderby') != 'rtng_rtng')
        return;

    $object->set('meta_key', 'rtng');
    $object->set('orderby', 'meta_value_num');
}



add_action('init', 'register_post_types');

function register_post_types()
{

    register_post_type('news', [
        'label' => null,
        'labels' => [
            'name' => 'Статьи', // основное название для типа записи
            'singular_name' => 'Статья', // название для одной записи этого типа
            'add_new' => 'Добавить статью', // для добавления новой записи
            'add_new_item' => 'Добавление статьи', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование статьи', // для редактирования типа записи
            'new_item' => 'Новая статья', // текст новой записи
            'view_item' => 'Смотреть статью', // для просмотра записи этого типа.
            'search_items' => 'Искать статьи', // для поиска по этим типам записи
            'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon' => '', // для родителей (у древовидных типов)
            'menu_name' => 'Статьи', // название меню
        ],
        'description' => '',
        'public' => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu' => null, // показывать ли в меню адмнки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest' => null, // добавить в REST API. C WP 4.7
        'rest_base' => null, // $post_type. C WP 4.7
        'menu_position' => null,
        'menu_icon' => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies' => [],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ]);

}

add_theme_support('post-thumbnails', array('post', 'news'));
add_theme_support('excerpt', array('post', 'news'));
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'XML generator',
        'menu_title' => 'XML generator',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
    acf_add_options_page(array(
        'page_title' => 'Клиенты',
        'menu_title' => 'Клиенты',
        'menu_slug' => 'theme-general-settings1',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
    acf_add_options_page(array(
        'page_title' => 'Отзывы',
        'menu_title' => 'Отзывы',
        'menu_slug' => 'theme-general-settings2',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}


// // Запускаем функцию при инициализации админки
// function remove_duplicate_content_from_acf() {
//     // Получаем все посты любого типа
//     $posts = get_posts([
//         'posts_per_page' => -1,
//         'post_type' => 'any', // Любой тип поста
//     ]);

//     // Определяем контент, который нужно удалить
//     $content_to_remove = '<h2>Как проходит обучение в ЕЦОП</h2>
// <ul>
// <li>1) Выбираете курс (Переходите на страницу курса)</li>
// <li>2) Скачиваете и заполняете заявку, отправляете нам на почту <a href="mailto:info@ecoprf.ru">info@ecoprf.ru</a></li>
// <li>3) Оплачиваете счёт, который мы вам пришлем</li>
// <li>4) Получаете доступ к учебному материалу</li>
// <li>5) Проходите аттестацию</li>
// <li>6) Получаете итоговый документ</li>
// </ul>';

//     // Проходим по каждому посту
//     foreach ($posts as $post) {
//         // Получаем текущее значение поля ACF
//         $current_content = get_field('seo_tekst_v_koncze_straniczy', $post->ID);

//         // Проверяем, если контент уже существует в поле
//         if (strpos($current_content, $content_to_remove) !== false) {
//             // Удаляем дубликат
//             $new_content = str_replace($content_to_remove, '', $current_content);

//             // Обновляем значение поля ACF без дубликата
//             update_field('seo_tekst_v_koncze_straniczy', trim($new_content), $post->ID);
//         }
//     }
// }

// // Запускаем функцию при инициализации админки
// add_action('init', 'remove_duplicate_content_from_acf');

// function update_all_seo_texts() {
//     // Получаем все страницы
//     $pages = get_posts(array(

//         'posts_per_page' => -1,
//         'meta_key' => 'seo_tekst_v_koncze_straniczy',
//         'meta_compare' => 'EXISTS'
//     ));

//     foreach ($pages as $page) {
//         // Получаем текущее содержимое поля ACF
//         $current_content = get_field('seo_tekst_v_koncze_straniczy', $page->ID);

//         if ($current_content) {
//             // HTML-контент, который нужно добавить
//             $additional_content = '<h2>Как проходит обучение в ЕЦОП</h2>
//             <ul>
//                 <li>1) Выбираете курс (Переходите на страницу курса)</li>
//                 <li>2) Скачиваете и заполняете заявку, отправляете нам на почту <a href="mailto:info@ecoprf.ru">info@ecoprf.ru</a></li>
//                 <li>3) Оплачиваете счёт, который мы вам пришлем</li>
//                 <li>4) Получаете доступ к учебному материалу</li>
//                 <li>5) Проходите аттестацию</li>
//                 <li>6) Получаете итоговый документ</li>
//             </ul>';

//             // Обновляем поле, добавляя новый контент после существующего
//             update_field('seo_tekst_v_koncze_straniczy', $current_content . $additional_content, $page->ID);
//         }
//     }
// }

// // Запускаем функцию один раз
// update_all_seo_texts();
// 
// 
add_action('template_redirect', function () {
    if (is_page_template('page-course.php')) {
        $post_id = get_the_ID();

        // Получаем текущие просмотренные курсы из куки
        $viewed = isset($_COOKIE['viewed_courses']) ? explode(',', $_COOKIE['viewed_courses']) : [];

        // Добавляем, если ещё не добавлен
        if (!in_array($post_id, $viewed)) {
            $viewed[] = $post_id;
            // Ограничим до 10 последних
            $viewed = array_slice($viewed, -10);
            // Устанавливаем куку на 30 дней
            setcookie('viewed_courses', implode(',', $viewed), time() + 60 * 60 * 24 * 30, "/");
        }
    }
});


// require_once get_template_directory() . '/libs/phpword/PHPWord-master/src/PhpWord/Autoloader.php';
// \PhpOffice\PhpWord\Autoloader::register();



function my_create_course_doc_on_publish($post_id, $post, $update)
{
    // Логируем триггер
    error_log("=== my_create_course_doc_on_publish START for post ID: $post_id ===");

    // Проверяем, чтобы это был нужный тип поста
    if ($post->post_type !== 'post') {
        error_log("NOT a post, exit");
        return;
    }

    // Проверяем статус публикации
    if ($post->post_status !== 'publish') {
        error_log("Post status is not publish: {$post->post_status}, exit");
        return;
    }

    // Проверяем, что это именно переход в статус publish (исключаем повторные вызовы)
    $old_status = get_post_meta($post_id, '_old_post_status', true);
    if ($old_status === 'publish') {
        error_log("Old status was already publish, skipping");
        return;
    }

    // Обновляем мета с текущим статусом
    update_post_meta($post_id, '_old_post_status', 'publish');

    // Подключаем PHPWord, если не подключен
    if (!class_exists('\PhpOffice\PhpWord\TemplateProcessor')) {
        require_once ABSPATH . 'wp-content/themes/Ecoprf/libs/phpword/PHPWord-master/src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
    }

    // Путь до шаблона
    $templatePath = ABSPATH . 'wp-content/themes/Ecoprf/templates/fizlic3.docx';

    if (!file_exists($templatePath)) {
        error_log("Template file not found: $templatePath");
        return;
    }

    // Получаем данные
    $title = get_the_title($post_id);
    $duration = get_field('prodolzhitelnost', $post_id) ?: '—';

    error_log("Generating doc for course '$title', duration '$duration'");

    // Функция транслитерации
    $slug = trim($title);
    $slug = strtr($slug, [
        'А' => 'a',
        'Б' => 'b',
        'В' => 'v',
        'Г' => 'g',
        'Д' => 'd',
        'Е' => 'e',
        'Ё' => 'e',
        'Ж' => 'zh',
        'З' => 'z',
        'И' => 'i',
        'Й' => 'y',
        'К' => 'k',
        'Л' => 'l',
        'М' => 'm',
        'Н' => 'n',
        'О' => 'o',
        'П' => 'p',
        'Р' => 'r',
        'С' => 's',
        'Т' => 't',
        'У' => 'u',
        'Ф' => 'f',
        'Х' => 'h',
        'Ц' => 'ts',
        'Ч' => 'ch',
        'Ш' => 'sh',
        'Щ' => 'sch',
        'Ь' => '',
        'Ы' => 'y',
        'Ъ' => '',
        'Э' => 'e',
        'Ю' => 'yu',
        'Я' => 'ya',
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ь' => '',
        'ы' => 'y',
        'ъ' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        ' ' => '-',
        '—' => '-',
        '_' => '-',
        '«' => '',
        '»' => '',
        '"' => '',
        "'" => '',
        ',' => ''
    ]);
    // Приведение к нижнему регистру после транслитерации
    $slug = strtolower($slug);

    $slug = preg_replace('/[^a-z0-9\-]+/', '', $slug);
    $slug = trim($slug, '-');
    if (empty($slug)) {
        $slug = 'file_' . time();
    }

    try {
        $processor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        $processor->setValue('course_title', $title);
        $processor->setValue('course_time', $duration);

        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['path'] . '/' . $slug . '_fiz_new.docx';
        $processor->saveAs($file_path);

        error_log("File saved: $file_path");

        // Проверяем, есть ли уже файл в ACF поле
        $existing_value = get_field('zayavka_fiz_liczo2', $post_id);

        $existing_id = 0;
        if (is_numeric($existing_value)) {
            $post_attach = get_post((int) $existing_value);
            if ($post_attach && $post_attach->post_type === 'attachment') {
                $existing_id = (int) $existing_value;
            }
        }

        if ($existing_id) {
            update_attached_file($existing_id, $file_path);
            $attach_id = $existing_id;
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            error_log("Updated attachment metadata (ID $attach_id)");
        } else {
            $filetype = wp_check_filetype(basename($file_path), null);
            $attachment = [
                'post_mime_type' => $filetype['type'],
                'post_title' => $title,
                'post_content' => '',
                'post_status' => 'inherit',
            ];
            $attach_id = wp_insert_attachment($attachment, $file_path, $post_id);
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            error_log("Inserted new attachment (ID $attach_id)");
        }

        $success = update_field('zayavka_fiz_liczo2', $attach_id, $post_id);

        if ($success) {
            error_log("✅ ACF field zayavka_fiz_liczo2 updated");
        } else {
            error_log("❌ Failed to update ACF field zayavka_fiz_liczo2");
        }
        my_create_course_doc_for_yur($post_id, $post);

    } catch (Throwable $e) {
        error_log("Exception: " . $e->getMessage());
    }
}

function my_create_course_doc_for_yur($post_id, $post)
{
    // Подключаем PHPWord, если не подключен
    if (!class_exists('\PhpOffice\PhpWord\TemplateProcessor')) {
        require_once ABSPATH . 'wp-content/themes/Ecoprf/libs/phpword/PHPWord-master/src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
    }

    // Путь до шаблона для юр. лиц
    $templatePath = ABSPATH . 'wp-content/themes/Ecoprf/templates/yul.docx';

    if (!file_exists($templatePath)) {
        error_log("Template YUR file not found: $templatePath");
        return;
    }

    // Получаем данные
    $title = get_the_title($post_id);
    $duration = get_field('prodolzhitelnost', $post_id) ?: '—';

    // Функция транслитерации
    $slug = trim($title);
    $slug = strtr($slug, [
        'А' => 'a',
        'Б' => 'b',
        'В' => 'v',
        'Г' => 'g',
        'Д' => 'd',
        'Е' => 'e',
        'Ё' => 'e',
        'Ж' => 'zh',
        'З' => 'z',
        'И' => 'i',
        'Й' => 'y',
        'К' => 'k',
        'Л' => 'l',
        'М' => 'm',
        'Н' => 'n',
        'О' => 'o',
        'П' => 'p',
        'Р' => 'r',
        'С' => 's',
        'Т' => 't',
        'У' => 'u',
        'Ф' => 'f',
        'Х' => 'h',
        'Ц' => 'ts',
        'Ч' => 'ch',
        'Ш' => 'sh',
        'Щ' => 'sch',
        'Ь' => '',
        'Ы' => 'y',
        'Ъ' => '',
        'Э' => 'e',
        'Ю' => 'yu',
        'Я' => 'ya',
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ь' => '',
        'ы' => 'y',
        'ъ' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        ' ' => '-',
        '—' => '-',
        '_' => '-',
        '«' => '',
        '»' => '',
        '"' => '',
        "'" => '',
        ',' => ''
    ]);
    // Приведение к нижнему регистру после транслитерации
    $slug = strtolower($slug);

    $slug = preg_replace('/[^a-z0-9\-]+/', '', $slug);
    $slug = trim($slug, '-');

    if (empty($slug)) {
        $slug = 'file_' . time();
    }

    try {
        $processor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        $processor->setValue('course_title', $title);
        $processor->setValue('course_time', $duration);

        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['path'] . '/' . $slug . '_yur_new.docx';
        $processor->saveAs($file_path);

        error_log("YUR File saved: $file_path");

        // Проверка и прикрепление к ACF
        $existing_value = get_field('zayavka_yur_liczo1', $post_id);
        $existing_id = 0;

        if (is_numeric($existing_value)) {
            $post_attach = get_post((int) $existing_value);
            if ($post_attach && $post_attach->post_type === 'attachment') {
                $existing_id = (int) $existing_value;
            }
        }

        if ($existing_id) {
            update_attached_file($existing_id, $file_path);
            $attach_id = $existing_id;
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            error_log("YUR: Updated attachment metadata (ID $attach_id)");
        } else {
            $filetype = wp_check_filetype(basename($file_path), null);
            $attachment = [
                'post_mime_type' => $filetype['type'],
                'post_title' => $title,
                'post_content' => '',
                'post_status' => 'inherit',
            ];
            $attach_id = wp_insert_attachment($attachment, $file_path, $post_id);
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            error_log("YUR: Inserted new attachment (ID $attach_id)");
        }

        $success = update_field('zayavka_yur_liczo1', $attach_id, $post_id);

        if ($success) {
            error_log("✅ ACF field zayavka_yur_liczo1 updated");
        } else {
            error_log("❌ Failed to update ACF field zayavka_yur_liczo1");
        }

    } catch (Throwable $e) {
        error_log("YUR Exception: " . $e->getMessage());
    }
}

add_action('save_post', 'my_create_course_doc_on_publish', 10, 3);


// === Подкатегории ===
add_action('wp_ajax_get_subcategories', 'get_subcategories_callback');
add_action('wp_ajax_nopriv_get_subcategories', 'get_subcategories_callback');

function get_subcategories_callback()
{
    $category_id = intval($_GET['category_id']);

    $terms = get_terms([
        'taxonomy' => 'category',
        'parent' => $category_id,
        'hide_empty' => false,
    ]);

    $result = [];

    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {
            $result[] = [
                'id' => $term->term_id,
                'name' => $term->name,
            ];
        }
    }

    wp_send_json($result);
}

// === Курсы ===
add_action('wp_ajax_get_courses', 'get_courses_callback');
add_action('wp_ajax_nopriv_get_courses', 'get_courses_callback');

function get_courses_callback()
{
    $subcategory_id = intval($_GET['subcategory_id']);

    if (!$subcategory_id) {
        wp_send_json([]);
    }

    $query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => [$subcategory_id],
                'include_children' => false, // ВАЖНО
            ]
        ],
    ]);

    $result = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $result[] = [
                'id' => get_the_ID(),
                'name' => get_the_title(),
                'price' => (float) get_field('stoimost_kursa', get_the_ID()),
            ];
        }
        wp_reset_postdata();
    }

    wp_send_json($result);
}


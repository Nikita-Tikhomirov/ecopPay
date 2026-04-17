<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
 // ** Расширил лимит памяти ** //
define('WP_MEMORY_LIMIT', '256M');
// ** Отключил автообновление WP ** //
define( 'AUTOMATIC_UPDATER_DISABLED', true );
// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //

/** Имя базы данных для WordPress */
define( 'DB_NAME', 'ecoprf_base' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'ecoprf_base' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'jaK64&bF' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ':KIn9T1i/xP%L7ZN(o/8q/cVkktIM@AwFd4+0<>/Gm |q/y`D qA@J)%uFUcyJN_' );
define( 'SECURE_AUTH_KEY',  'W`%$]u=(NAyu^qAgw5!;nekvJhfK,[=@h3Sh0g)BFvbBhtVrLXTZ>QPk5N8-/ws&' );
define( 'LOGGED_IN_KEY',    '(T}*WBV;O<bqa.ymkT k7aPErxs/9+r;(ut5=)2cjiF3>1r2l!cHtU[dV!Jo[~h;' );
define( 'NONCE_KEY',        'W`4S2&c#-23;0asEj;ZErm7gWY/@!%1&Yi$s{n7nvYUiaL8&Gw;93FMWGE|I>Z16' );
define( 'AUTH_SALT',        '?$:ZLL2c3 xzbO8?#-0*fcli(yd19o$gQ*j+G81HR%CicbgIg+%C-C9Q)[bwvet#' );
define( 'SECURE_AUTH_SALT', '[tmJ4$QYm1wfNX@Ks5dc!,Tr#[}GD#.K=wN$CF=7U=_V<q=.x5_PRlx#x;2Fyk!0' );
define( 'LOGGED_IN_SALT',   '@~d6xn2Vy&}w|T|BGtf$5?Js#>pxEy9x>kG4GOo~,CHct%n&lXRh[{;6|YC]jyIZ' );
define( 'NONCE_SALT',       'Oar|R^`y+!HDFzZ[|}yj]/..@f{8(rX.bI3bPt==i8-.tX,)fLH1$w+=bjw@EM7-' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'ec_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);


/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';

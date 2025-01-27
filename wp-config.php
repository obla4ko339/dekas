<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
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

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'cn50487_dekatr' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'cn50487_dekatr' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '2wmtXUM4' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'TU6=w_on}w#eC<%~eN1Q@CQf2WzMs^$lx{oZfT)t[x>zw.rk9t&gqw$<xje)6.~M' );
define( 'SECURE_AUTH_KEY',  ':bo&/+^>Xy`~11]Ckn(0[*[f+FU;w:P2-jn&kTeeh:f%M b(L!yzN3-^:oe2+!y6' );
define( 'LOGGED_IN_KEY',    '7(?&VmA?1Xu.#D5RD1vu-W}9h.**|wh_St9Spf.?XVvmov{.Z0Plj1u*]Rqk=xwu' );
define( 'NONCE_KEY',        'uk,u,[dZm>y{ldX+Tr7_KIUinyv6L<*t3>p{!=m@rk0aY8mxwT6q]rvEIhf!>7#o' );
define( 'AUTH_SALT',        'i*P rbCg+6-}=e#4}@m<eS ^1<]}PAY^C vtD(hOZR9HZvO=^Jff%k4)CHM`yz&%' );
define( 'SECURE_AUTH_SALT', '8g]?|~;foX.#_R*$=zW jw/-<NwqpDQ8E8~/=$l.r$HCXjBE =/[C(VHGbqOC:Fc' );
define( 'LOGGED_IN_SALT',   'Eh~*;jXCpF^;7gim5g~y|>JTY`;o2zj:Tnhi|{Tpr[rd0-z7f=-CQUv^|frlOu 2' );
define( 'NONCE_SALT',       '8V?J6z*A)Uf[e1,GbA#M0Yqpv^hPcloB)-_{7%6!D~mN10y{7/9q8/Ddmkg[&g67' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';

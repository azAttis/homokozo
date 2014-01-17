<?php
require 'config.php';

// ==================================================================
//
// [ Set constants ]
//
// ------------------------------------------------------------------

define('APP_FULLPATH', __DIR__ . '/..');

// ==================================================================
//
// [ Error reporting off ]
//
// ------------------------------------------------------------------

if (defined('ERROR_REPORTING_ON') && ERROR_REPORTING_ON) {
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', true);
}

if (isset($_GET['phpinfo']) && $_GET['phpinfo'] == 'asdf' && APP_DEBUG) {
    phpinfo();
    die;
}

// ==================================================================
//
// [ Set header ]
//
// ------------------------------------------------------------------

header('Content-Type: text/html; charset=utf-8');

// ==================================================================
//
// [ Set autoloader ]
//
// ------------------------------------------------------------------

/**
 * Autoload function, throws Exceptions and prepends loader function
 *
 * @param  string $osztalynev classname to load
 *
 * @return void
 */
spl_autoload_register(function ($osztalynev)
{
    include APP_FULLPATH . '/classes/' .  str_replace('\\', '/', $osztalynev) . '.class.php';

    return 1;
}, true, true);

// ==================================================================
//
// [ Check required modules availability ]
//
// ------------------------------------------------------------------

if (!function_exists('igbinary_serialize')) {
    throw new Exception('igbinary module is not available!');
}

if (!function_exists('numfmt_format_currency')) {
    throw new Exception('intl module is not available!');
}

if (!function_exists('xhprof_enable')) {
    throw new Exception('xhprof module is not available (http://github.com/preinheimer/xhprof)!');
}

if (!extension_loaded('memcached')) {
    throw new Exception('memcached is not available!');
} elseif (Memcached::HAVE_IGBINARY === 0) {
    throw new Exception('Memcached was not installed with enabled igbinary serializer!');
}

// ==================================================================
//
// [ Init memcached ]
//
// ------------------------------------------------------------------

$Memcached  = new Memcached();
$Memcached->addServer('localhost', 11211);
$Memcached->setOption(Memcached::OPT_SERIALIZER, Memcached::SERIALIZER_IGBINARY);

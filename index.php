<?php
// phpinfo();
// exit();
// Define application environment
if($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1"){ //Dados banco local
    define('APPLICATION_ENV', 'development');
}else{
    define('APPLICATION_ENV', 'production');
}

if (APPLICATION_ENV == 'production') {
    // Define path to application directory (locaweb)
    // defined('APPLICATION_PATH')
    //     || define('APPLICATION_PATH', __DIR__ . '/../../portal/application');

    defined('APPLICATION_PATH')
        || define('APPLICATION_PATH', __DIR__ . '/application');

} else {
    // Define path to application directory

    defined('APPLICATION_PATH')
        || define('APPLICATION_PATH', __DIR__ . '/application');

    // defined('APPLICATION_PATH')
    //     || define('APPLICATION_PATH', __DIR__ . '/../portal/application');    
}

// Define path to public directory
defined('PUBLIC_PATH')
    || define('PUBLIC_PATH', __DIR__);

if (!file_exists('vendor/autoload.php')) {
    // Ensure library/ is on include_path
    set_include_path(implode(
        PATH_SEPARATOR,
        array(
            realpath(APPLICATION_PATH . '/library'),
            get_include_path(),
        )
    ));

    require_once '../Zend/Application.php';
} else {
    require_once 'vendor/autoload.php';
}

// Não dá pra ajeitar todos os erros de E_STRICT…
error_reporting(E_ALL ^ E_STRICT);

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();

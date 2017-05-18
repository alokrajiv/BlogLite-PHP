<?php

/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

define('APP_DIR', __DIR__ . "/app/");
define('CNF_DIR', __DIR__ . "/config/");
define('BASE_DIR', __DIR__ . "/");

require_once CNF_DIR . 'auto_config.php';

use malkusch\autoloader\Autoloader;

/*
 * Autoloader-PHP Docs: the require instead of require_once.
 * That's because you might use other components which already use this '
 * autoloader implementation. So you really need to require the Autoloader
 * again, to make sure all class paths are registered.
 */
require BASE_DIR . "vendor/malkusch/php-autoloader/autoloader.php";

// As the guessed class path is wrong you should remove this Autoloader.
//Autoloader::getRegisteredAutoloader()->remove();
// register your arbitrary class path

$autoloader = new Autoloader(APP_DIR);
$autoloader->register();

//require_once APP_DIR . "main_router.php";
//
//
//disabling dbal now after doctrine orm
//require_once CNF_DIR . 'db_config.php';
/*
 * One advantage that Doctrine DBAL has over plain PDO is that the Doctrine
 * connection doesn't actually connect to the database until the first query
 *  is run. This means you can create the connection in the bootstrap of your
 *  application and if no queries are run for a particular request it wont need
 * to actually connect to the database server. PDO connects to the database
 * server as soon as you create a PDO instance.
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(BASE_DIR . "/app/entities"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
// database configuration parameters
$connection_params = array(
    'dbname' => getenv("CUSTOMCONNSTR_db_name"),
    'user' => getenv("CUSTOMCONNSTR_db_user"),
    'password' => getenv("CUSTOMCONNSTR_db_pswd"),
    'host' => getenv("CUSTOMCONNSTR_db_host"),
    'port' => 3306,
    'charset' => 'utf8',
    'driver' => 'pdo_mysql',
);

// obtaining the entity manager
$entityManager = EntityManager::create($connection_params, $config);

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(APP_DIR . "views");
$twig = new Twig_Environment($loader, array(
    'cache' => BASE_DIR . 'template_cache',
    'auto_reload' => true, //remove when not developing
        )
);


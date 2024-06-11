<?php
declare(strict_types=1);

use gift\appli\infrastructure\Eloquent;

require_once __DIR__ . '/../src/vendor/autoload.php';

Eloquent::init(__DIR__ . '/../src/conf/gift.db.conf.ini');

$app = require_once __DIR__ . '/../src/conf/boostrap.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Constantes d'opérations
define('CREATE_BOX', 1);
define('EDIT_BOX', 2);
define('EDIT_CATALOGUE', 3);

$app->run();
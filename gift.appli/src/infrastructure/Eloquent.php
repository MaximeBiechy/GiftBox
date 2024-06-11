<?php
declare(strict_types=1);

namespace gift\appli\infrastructure;

use Illuminate\Database\Capsule\Manager as DB;

class Eloquent
{
    public static function init(string $configFile): void
    {
        $db = new DB();
        $db->addConnection(parse_ini_file($configFile));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}

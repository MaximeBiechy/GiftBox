<?php

namespace gift\appli\core\services\catalogue;

use Exception;

class CatalogueServiceNotFoundException extends Exception
{

    public function __construct($message)
    {
        parent::__construct($message);
    }
}

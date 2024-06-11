<?php

namespace gift\appli\core\services\box;

use Exception;

class BoxServiceNotFoundException extends Exception {
        
        public function __construct($message) {
            parent::__construct($message);
        }
}
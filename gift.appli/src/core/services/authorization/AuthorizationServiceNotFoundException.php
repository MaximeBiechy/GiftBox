<?php

namespace gift\appli\core\services\authorization;

use Exception;

class AuthorizationServiceNotFoundException extends Exception {
        
        public function __construct($message) {
            parent::__construct($message);
        }
}
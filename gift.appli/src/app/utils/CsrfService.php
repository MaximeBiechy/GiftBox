<?php 
declare(strict_types=1);

namespace gift\appli\app\utils;

class CsrfService {

    public static function generate(): string {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $token;
        return $token;
    }
    
    public static function check($token) {
        if (!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $token) {
            throw new \Exception('Le token est invalide');
        }
        unset($_SESSION['csrf']);
    }
}
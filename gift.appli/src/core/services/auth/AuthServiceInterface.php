<?php

namespace gift\appli\core\services\auth;

use gift\appli\core\domain\entities\User;

interface AuthServiceInterface {

    public function register(string $user_id, string $password): string;
    public function byCredentials(string $user_id, string $password): bool;
    public function getUser(string $email): array;
    
}
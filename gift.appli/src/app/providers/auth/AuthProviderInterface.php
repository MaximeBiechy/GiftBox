<?php

namespace gift\appli\app\providers\auth;

use gift\appli\core\domain\entities\User;

interface AuthProviderInterface {

    public function register(string $email, string $password): void;
    public function signin(string $email, string $pasword): void;
    public function signout(): void;
    public function isSignedIn(): bool;
    public function getSignedInUser(): array;
}
<?php

namespace gift\appli\app\providers\auth;

use gift\appli\core\services\auth\AuthService;
use gift\appli\core\services\auth\AuthServiceInterface;

class SessionAuthProvider implements AuthProviderInterface {
    
    private AuthServiceInterface $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function register(string $email, string $password): void {
        $this->authService->register($email, $password);
    }

    public function signin(string $email, string $pasword): void {
        if (!$this->authService->byCredentials($email, $pasword)) {
            throw new \Exception('Identifiants incorrects');
        }

        $user = $this->authService->getUser($email);

        $_SESSION['user'] = $user;
    }

    public function signout(): void {
        session_destroy();
    }
    public function isSignedIn(): bool {
        return isset($_SESSION['user']);
    }
    public function getSignedInUser(): array {
        return $_SESSION['user'];
    }
}
<?php

namespace gift\appli\core\services\auth;

use gift\appli\core\domain\entities\User;

class AuthService implements AuthServiceInterface {

    public function register(string $user_id, string $password): string {
        if (!filter_var($user_id, FILTER_VALIDATE_EMAIL)) throw new \Exception('L\'adresse email n\'est pas valide.');
        
        $user = User::where('user_id', $user_id)->first();
        if ($user) {
            throw new \Exception('L\'utilisateur existe déjà.');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $user = new User();
        $user->user_id = $user_id;
        $user->password = $hash;
        $user->role = 1;
        $user->save();
        return $user->id;
    }

    public function byCredentials(string $user_id, string $password): bool {
        $user = User::where('user_id', $user_id)->first();
        if (!$user) {
            return false;
        }
        return password_verify($password, $user->password);
    }

    public function getUser(string $user_id): array {
        return User::where('user_id', $user_id)->first()->toArray();
    }
    
}
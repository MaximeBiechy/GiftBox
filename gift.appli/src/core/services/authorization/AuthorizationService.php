<?php

namespace gift\appli\core\services\authorization;

use gift\appli\core\domain\entities\Box;
use gift\appli\core\domain\entities\User;

class AuthorizationService implements AuthorizationServiceInterface {

    public function isGranted(string $user_id, int $operation, string $ressource_id): bool {
        switch ($operation) {
            case CREATE_BOX:
                return $this->isAdmin($user_id) || $_SESSION['user'];
            case EDIT_BOX:
                return $this->isAdmin($user_id) || $this->isOwner($user_id, $ressource_id);
            case EDIT_CATALOGUE:
                return $this->isAdmin($user_id);
            default:
                return false;
        }
    }

    private function isAdmin(string $user_id): bool {
        return User::find($user_id)['role'] === 100;
    }

    private function isOwner(string $user_id, string $ressource_id): bool {
        return Box::find($ressource_id)['createur_id'] === $user_id;
    }
}
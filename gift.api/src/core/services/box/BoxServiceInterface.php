<?php

namespace gift\api\core\services\box;

interface BoxServiceInterface
{
    public function getBoxes(): array;
    public function getBoxById(string $id): array;
    public function createBox(array $data): string;
    public function updateBox(array $data): void;
    public function deleteBox(string $id): void;
    public function getBoxByUser(string $user_id): array;
    public function getBoxByPrestation(string $presta_id): array;
    public function addPrestationToBox(string $box_id, string $presta_id, int $quantite): void;
    public function removePrestationFromBox(string $box_id, string $presta_id): void;
    public function getPrestationsFromBox(string $box_id): array;
    public function updatePrestationQuantity(string $box_id, string $presta_id, int $quantity): int;
    public function getPredifinedBoxes(): array;
    public function delPrestationFromBox(string $box_id, string $presta_id): void;
    public function validateBox(string $box_id): void;
    public function payBox(string $box_id): void;
    public function deliverBox(string $box_id): void;
    public function getTokenbyBox(string $box_id): string;
    public function getBoxByToken(string $token): array;
}
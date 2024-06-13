<?php

namespace gift\api\core\services\catalogue;

interface CatalogueServiceInterface
{
    public function getCategories(): array;
    public function getPrestationsAsc(): array;
    public function getPrestationsDesc(): array;
    public function getCategorieById(int $id): array;
    public function getPrestations();
    public function getPrestationById(string $id): array;
    public function getPrestationsbyCategorie(int $categ_id):array;
    public function getPrestationsByCategories(): array;
    public function createCategorie(array $data): int;
    public function updatePrestation(array $data): void;
    public function defineOrUpdatePrestationToCategorie(int $categ_id, string $presta_id): void;

}
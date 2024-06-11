<?php

namespace gift\appli\core\services\catalogue;

interface CatalogueServiceInterface
{
    public function getCategories(): array;
    public function getPrestations(): array;
    public function getCategorieById(int $id): array;
    public function getPrestationById(string $id): array;
    public function getPrestationsbyCategorie(int $categ_id): array;
    public function createCategorie(array $data): int;
    public function updatePrestation(array $data);
    public function updateCategorieOfPrestation(int $prestation_id, int $categ_id);
}

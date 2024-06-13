<?php

namespace gift\api\core\services\catalogue;

use gift\api\core\domain\entities\Categorie;
use gift\api\core\domain\entities\Prestation;

class CatalogueService implements CatalogueServiceInterface
{

    public function getCategories(): array
    {
        $categories = Categorie::all();
        return $categories->toArray();
    }

    public function getCategorieById(int $id): array
    {
        try {
            $categorie = Categorie::findOrFail($id);
        } catch (\Exception $e) {
            throw new CatalogueServiceNotFoundException("La catégorie n'existe pas");
        }

        return $categorie->toArray();
    }

    public function getPrestationById(string $id): array
    {
        try {
            $prestation = Prestation::findOrFail($id);
        } catch (\Exception $e) {
            throw new CatalogueServiceNotFoundException("La prestation n'existe pas");
        }
        return $prestation->toArray();
    }

    public function getPrestationsbyCategorie(int $categ_id): array
    {
        try {
            $categorie = Categorie::findOrFail($categ_id);
        } catch (\Exception $e) {
            throw new CatalogueServiceNotFoundException("La catégorie n'existe pas");
        }
        $prestations = $categorie->prestations;
        return $prestations->toArray();
    }

    public function createCategorie(array $data): int
    {

        if ($data['libelle'] !== filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS)
            || $data['description'] !== filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS) ||
            $data['img'] !== filter_var($data['img'], FILTER_SANITIZE_SPECIAL_CHARS)){
            throw new CatalogueServiceBadException("Donnée suspecte");
        }
        $categorie = new Categorie();
        $categorie->libelle = $data['libelle'];
        $categorie->description = $data['description'];
        $categorie->img = $data['img'];
        $categorie->save();
        return $categorie->id;
    }

    public function updatePrestation(array $data): void
    {
        $prestation = Prestation::find($data['id']);
        foreach ($data as $key => $value) {
            $prestation->$key = $value;
        }
        $prestation->save();

    }

    public function defineOrUpdatePrestationToCategorie(int $categ_id, string $presta_id): void
    {
        $categorie = Categorie::find($categ_id);
        $prestation = Prestation::find($presta_id);
        $categorie->prestations()->save($prestation);
    }

    public function getPrestationsAsc(): array
    {
        $prestations = Prestation::with('categorie')->orderBy('tarif')->get();

        return $prestations->toArray();

    }

    public function getPrestationsDesc(): array
    {
        $prestations = Prestation::with('categorie')->orderByDesc('tarif')->get();

        return $prestations->toArray();
    }

    public function getPrestations(): array
    {
        $prestations = Prestation::with('categorie')->get();

        return $prestations->toArray();
    }

    public function getPrestationsByCategories(): array
    {
        $categories = Categorie::with('prestations')->get();
        return $categories->toArray();
    }
}
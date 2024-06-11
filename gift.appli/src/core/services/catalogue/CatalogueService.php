<?php 
declare(strict_types=1); 

namespace gift\appli\core\services\catalogue;

use Exception;
use gift\appli\core\domain\entities\Box;
use gift\appli\core\domain\entities\Categorie;
use gift\appli\core\domain\entities\Prestation;

class CatalogueService implements CatalogueServiceInterface {

    public function getCategories() : array {
        $categories = Categorie::all();
        return $categories->toArray();
    }

    public function getPrestations() : array {
        $prestations = Prestation::orderBy('tarif')->get();
        return $prestations->toArray();
    }

    public function getCategorieById(int $id) : array {
        try {
            $categorie = Categorie::findOrFail($id);
        } catch (Exception $e) {
            throw new CatalogueServiceNotFoundException("La catégorie avec l'id : $id n'existe pas.");
        }
        return $categorie->toArray();
    }

    public function getPrestationById(string $id) : array {
        try {
            $prestation = Prestation::findOrFail($id);
        } catch (Exception $e) {
            throw new CatalogueServiceNotFoundException("La prestation avec l'id : $id n'existe pas.");
        }
        return $prestation->toArray();
    }

    public function getPrestationsByCategorie(int $categ_id) : array {
        try {
            $prestations = Prestation::where('cat_id', $categ_id)->get();
        } catch (Exception $e) {
            throw new CatalogueServiceNotFoundException("La catégorie avec l'id $categ_id n'existe pas.");
        }
        return $prestations->toArray();
    }

    public function createCategorie(array $data): int {
        echo $data['libelle'];
        $categorie = new Categorie();
        $categorie->libelle = $data['libelle'];
        $categorie->description = $data['description'];
        $categorie->img = $data['img'];
        $categorie->save();
        return $categorie->id;
    }

    public function updatePrestation(array $data) {
        $prestation_id = $data['id'];
        $prestation = Prestation::findOrFail($prestation_id);
        foreach ($data as $property => $value) {
            if ($property !== 'id') {
                $prestation->$property = $value;
            }
        }
        $prestation->save();
    }

    public function updateCategorieOfPrestation(int $prestation_id, int $categ_id) {
        try {
            $prestation = Prestation::findOrFail($prestation_id);
            $prestation->cat_id = $categ_id;
            $prestation->save();
        } catch (Exception $e) {
            throw new CatalogueServiceNotFoundException("La prestation avec l'id $prestation_id n'existe pas.");
        }
    }
}
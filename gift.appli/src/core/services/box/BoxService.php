<?php

namespace gift\appli\core\services\box;

use gift\appli\core\domain\entities\Box;
use gift\appli\core\domain\entities\Prestation;

class BoxService implements BoxServiceInterface {
    
    public function getBoxFromUser(string $idUser): array
    {
        $box = Box::where('createur_id', $idUser)->get();
        return $box->toArray();   
    }

    public function createBox(array $data) : string {
        $box = new Box();
        $box->token = bin2hex(random_bytes(32));
        $box->libelle = $data['libelle'];
        $box->description = $data['description'];
        $box->kdo = $data['cadeau'];
        $box->createur_id = $_SESSION['user']['id'];
        if ($data['cadeau'] == 1) {
            $box->message_kdo = $data['message_kdo'];
        }
        $box->save();
        return $box->id;
    }

    public function addPrestationToBox(string $idPresta, string $idBox): void
    {
        $box = Box::find($idBox);
        $prestations = Prestation::findOrfail($idPresta);
        $prestation = Prestation::findOrFail($idPresta);

        $prestation = Prestation::findOrFail($idPresta);

        $existingPrestation = $box->prestations()->where('presta_id', $idPresta)->first();
    
        if ($existingPrestation) {
            $box->prestations()->updateExistingPivot($idPresta, ['quantite' => $existingPrestation->pivot->quantite + 1]);
        } else {
            $box->prestations()->attach($idPresta, ['quantite' => 1]);
        }
    }
    
    public function getPrestationFromBox(string $idBox): array
    {
        $box = Box::find($idBox);
        $prestations = $box->prestations;
        return $prestations->toArray();
    }

    public function deletePrestationFromBox(string $idBox, string $idPresta): void
    {
        $box = Box::findOrFail($idBox);
        $box->prestations()->detach($idPresta);
    }

    public function defineCurrentBox(string $idBox): void
    {
        $_SESSION['box'] = Box::findOrFail($idBox);
    }
}
<?php

namespace gift\appli\core\services\box;

use gift\appli\core\domain\entities\Box;

class BoxService implements BoxServiceInterface {
    
    public function getBoxFromUser(string $idUser): array
    {
        $box = Box::where('createur_id', $idUser)->where('predefinie', 0)->get();
        return $box->toArray();   
    }

    public function getBoxPredefinis(): array
    {
        $box = Box::where('predefinie', 1)->get();
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
        if ($data['predefinie'] == 1) {
            $box->predefinie = 1;
        }
        $box->save();
        return $box->id;
    }

    public function addPrestationToBox(string $idPresta, string $idBox): void
    {
        $box = Box::find($idBox);

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
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
        $_SESSION['state_box_detail'] = $box['statut'];
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
        $box = Box::findOrFail($idBox);
        $_SESSION['box'] = $box;
        $_SESSION['state_box_detail'] = $box['statut'];
    }

    public function validateBox(string $idBox): void
    {

        if ($_SESSION['user']['id'] == $_SESSION['box']->createur_id) {
            $box = Box::findOrFail($idBox);
            $box->statut = Box::VALIDATED;
            $box->save();
        }

    }

    public function payedBox(string $idBox, string $id_url): void
    {
        $box = Box::findOrFail($idBox);
        $box->statut = Box::PAYED;
        $box->token= $id_url;
        $box->save();
    }
}
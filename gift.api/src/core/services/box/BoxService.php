<?php

namespace gift\api\core\services\box;

use gift\api\core\domain\entities\Box;
use gift\api\core\domain\entities\Prestation;

class BoxService implements BoxServiceInterface
{

    // Récupère toutes les boîtes et les retourne sous forme de tableau
    public function getBoxes(): array
    {
        $boxes = Box::all();
        return $boxes->toArray();
    }

    // Récupère une boîte par son ID
    public function getBoxById(string $id): array
    {
        try {
            $box = Box::findOrFail($id);
            return $box->toArray();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
    }

    // Crée une nouvelle boîte avec les données fournies
    public function createBox(array $data): string
    {
        // Vérifie et assainit les entrées utilisateur
        if ($data['libelle'] !== filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS)
            || $data['description'] !== filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS)
            || $data['message_kdo'] !== filter_var($data['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS)) {
            throw new BoxServiceBadException("Donnée suspecte");
        }
        // Crée et sauvegarde une nouvelle boîte
        $box = new Box();
        $box->token = bin2hex(random_bytes(32));
        $box->libelle = $data['libelle'];
        $box->description = $data['description'];
        $box->montant = 0;
        $box->kdo = $data['kdo'];
        $box->message_kdo = $data['message_kdo'];
        $box->statut = 1;
        $box->createur_id = $_SESSION['user']['id'];
        $box->save();
        $_SESSION['box'] = $box->id;
        return $box->id;
    }

    // Met à jour une boîte existante avec les données fournies
    public function updateBox(array $data): void
    {
        $box = Box::find($data['id']);
        $box->libelle = $data['libelle'];
        $box->description = $data['description'];
        $box->montant = $data['montant'];
        $box->kdo = $data['kdo'];
        $box->message_kdo = $data['message_kdo'];
        $box->status = $data['status'];
        $box->createur_id = $data['createur_id'];
        $box->save();
    }

    // Supprime une boîte par son ID
    public function deleteBox(string $id): void
    {
        $box = Box::find($id);
        $box->delete();
    }

    // Récupère les boîtes d'un utilisateur par son ID
    public function getBoxByUser(string $user_id): array
    {
        try {
            $boxes = Box::where('createur_id', $user_id)->get();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("Aucune box n'a été trouvée pour cet utilisateur");
        }
        return $boxes->toArray();
    }

    // Récupère les boîtes liées à une prestation par l'ID de la prestation
    public function getBoxByPrestation(string $presta_id): array
    {
        try {
            $prestation = Prestation::findOrFail($presta_id);
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La prestation n'existe pas");
        }
        $box = $prestation->box2presta()->get();
        return $box->toArray();
    }

    // Ajoute une prestation à une boîte avec une quantité spécifiée
    public function addPrestationToBox(string $box_id, string $presta_id, int $quantite): void
    {
        try {
            $box = Box::findOrFail($box_id);
            $prestation = Prestation::findOrFail($presta_id);

            $existingPrestation = $box->box2presta()->where('presta_id', $presta_id)->exists();
            if ($existingPrestation) {
                $quantite = $box->box2presta()->where('presta_id', $presta_id)->first()->pivot->quantite + $quantite;
                $this->updatePrestationQuantity($box_id, $presta_id, $quantite);
                return;
            }

            $box->montant += $quantite * $prestation->tarif;
            $box->save();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }

        // Attacher la prestation à la boîte
        $box->box2presta()->attach($presta_id, ['quantite' => $quantite]);
    }

    // Retire une prestation d'une boîte
    public function removePrestationFromBox(string $box_id, string $presta_id): void
    {
        try {
            $box = Box::findOrFail($box_id);
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
        try {
            $box->box2presta()->detach($presta_id);
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La prestation n'existe pas dans la box");
        }
    }

    // Récupère les prestations d'une boîte par l'ID de la boîte
    public function getPrestationsFromBox(string $box_id): array
    {
        try {
            $box = Box::findOrFail($box_id);
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
        $prestations = $box->box2presta()->withPivot('quantite')->get();
        return $prestations->toArray();
    }

    // Met à jour la quantité d'une prestation dans une boîte et retourne le prix total
    public function updatePrestationQuantity(string $box_id, string $presta_id, int $quantity): int
    {
        try {
            $box = Box::findOrFail($box_id);
            $prestation = $box->box2presta()->where('presta_id', $presta_id)->first();

            if ($prestation) {
                $prestation->pivot->quantite = $quantity;
                $prestation->pivot->save();
            }

            // Calcule le prix total de la boîte
            $totalPrice = $box->box2presta->sum(function ($prestation) {
                return $prestation->pivot->quantite * $prestation->tarif;
            });
            $box->montant = $totalPrice;
            $box->save();

            return $totalPrice;
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La prestation n'existe pas");
        }
    }

    // Récupère les boîtes prédefinies
    public function getPredifinedBoxes(): array
    {
        $boxes = Box::where('predefinie', 1)->get();
        return $boxes->toArray();
    }

    // Supprime une prestation d'une boîte et met à jour le montant total
    public function delPrestationFromBox(string $box_id, string $presta_id): void
    {
        try {
            $box = Box::findOrFail($box_id);
            $prestation = Prestation::findOrFail($presta_id);
            $quantite = $box->box2presta()->where('presta_id', $presta_id)->first()->pivot->quantite;
            $box->box2presta()->detach($presta_id);
            $box->montant -= $prestation->tarif * $quantite;
            $box->save();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box ou la prestation n'existe pas");
        }
    }

    // Valide une boîte en mettant à jour son statut
    public function validateBox(string $box_id): void
    {
        try {
            $box = Box::findOrFail($box_id);
            $box->statut = 2;
            $box->save();
            if ($box_id == $_SESSION['box']['id']) {
                unset($_SESSION['box']);
            }
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
    }

    // Marque une boîte comme payée en mettant à jour son statut
    public function payBox(string $box_id): void
    {
        try {
            $box = Box::findOrFail($box_id);
            $box->statut = 3;
            $box->save();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
    }

    // Marque une boîte comme livrée en mettant à jour son statut
    public function deliverBox(string $box_id): void
    {
        try {
            $box = Box::findOrFail($box_id);
            $box->statut = 4;
            $box->save();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
    }

    // Récupère le token associé à une boîte par son ID
    public function getTokenbyBox(string $box_id): string
    {
        try {
            $box = Box::findOrFail($box_id);
            return $box->token;
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
    }

    // Récupère une boîte par son token
    public function getBoxByToken(string $token): array
    {
        try {
            $box = Box::where('token', $token)->first();
            return $box->toArray();
        } catch (\Exception $e) {
            throw new BoxServiceNotFoundException("La box n'existe pas");
        }
    }
}

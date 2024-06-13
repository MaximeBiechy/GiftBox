<?php

namespace gift\api\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasUuids; // Utilise le trait HasUuids pour gérer les UUIDs comme clés primaires

    protected $table = 'prestation'; // Spécifie le nom de la table associée à ce modèle

    protected $primaryKey = 'id'; // Définit la clé primaire
    public $incrementing = false; // Indique que la clé primaire n'est pas un entier auto-incrémenté
    public $timestamps = false; // Indique que le modèle ne gère pas les colonnes created_at et updated_at

    public $keyType = 'string'; // Indique que la clé primaire est de type string

    // Définition de la relation many-to-one avec le modèle Categorie
    function categorie()
    {
        return $this->belongsTo('gift\api\core\domain\entities\Categorie', 'cat_id'); // Relation belongsTo avec Categorie
    }

    // Définition de la relation many-to-many avec le modèle Box
    function box2presta()
    {
        return $this->belongsToMany(
            'gift\api\core\domain\entities\Box', // Le modèle Box
            'box2presta', // La table pivot
            'presta_id', // La clé étrangère de ce modèle dans la table pivot
            'box_id' // La clé étrangère de l'autre modèle dans la table pivot
        )->withPivot(
            ['quantite'] // Inclut la colonne pivot 'quantite' dans les résultats
        );
    }
}

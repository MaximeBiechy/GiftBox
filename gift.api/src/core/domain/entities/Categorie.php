<?php

namespace gift\api\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie'; // Spécifie le nom de la table associée à ce modèle

    protected $primaryKey = 'id'; // Définit la clé primaire
    public $timestamps = false; // Indique que le modèle ne gère pas les colonnes created_at et updated_at

    // Définition de la relation one-to-many avec le modèle Prestation
    function prestations()
    {
        return $this->hasMany('gift\api\core\domain\entities\Prestation', 'cat_id'); // Relation hasMany avec Prestation
    }
}

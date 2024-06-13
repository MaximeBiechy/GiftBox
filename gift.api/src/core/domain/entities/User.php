<?php

namespace gift\api\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuids; // Utilise le trait HasUuids pour gérer les UUIDs comme clés primaires

    protected $table = 'user'; // Spécifie le nom de la table associée à ce modèle

    protected $primaryKey = 'id'; // Définit la clé primaire
    public $incrementing = false; // Indique que la clé primaire n'est pas un entier auto-incrémenté
    public $timestamps = false; // Indique que le modèle ne gère pas les colonnes created_at et updated_at

    public $keyType = 'string'; // Indique que la clé primaire est de type string

    // Définition de la relation one-to-many avec le modèle Box
    function boxes()
    {
        return $this->hasMany('gift\api\core\domain\entities\Box', 'createur_id'); // Relation hasMany avec Box
    }
}

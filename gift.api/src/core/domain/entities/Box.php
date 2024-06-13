<?php

namespace gift\api\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasUuids; // Utilise le trait HasUuids pour gérer les UUIDs comme clés primaires

    protected $table = 'box'; // Spécifie le nom de la table associée à ce modèle

    protected $primaryKey = 'id'; // Définit la clé primaire
    public $incrementing = false; // Indique que la clé primaire n'est pas un entier auto-incrémenté
    public $keyType = 'string'; // Indique que la clé primaire est de type string

    // Définition de la relation many-to-one avec le modèle User
    function createur()
    {
        return $this->belongsTo('gift\api\core\domain\entities\User', 'createur_id');
    }
}

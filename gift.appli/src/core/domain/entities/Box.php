<?php 
declare(strict_types=1);

namespace gift\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Box extends Model {
    
    use HasUuids;

    // Attributs
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = ['id', 'token', 'libelle', 'description', 'montant', 'kdo', 'message_kdo', 'status'];

    const CREATED = 1;
    const VALIDATED= 2;
    const PAYED = 3;
    const SENDED = 4;
    const USED = 5;

    // Méthodes
    public function prestations() {
        return $this->belongsToMany('gift\appli\core\domain\entities\Prestation', 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite');
    }
}


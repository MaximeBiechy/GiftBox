<?php 
declare(strict_types=1);

namespace gift\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model {

    // Attributs
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = ['id', 'libelle', 'description', 'url', 'unite', 'tarif'];

    // Méthodes 
    public function categorie() {
        return $this->belongsTo('gift\appli\core\domain\entities\Categorie', 'cat_id');
    }

    public function boxes() {
        return $this->belongsToMany('gift\appli\core\domain\entities\Box', 'box2presta', 'presta_id', 'box_id')
            ->withPivot('quantite');
    }
}


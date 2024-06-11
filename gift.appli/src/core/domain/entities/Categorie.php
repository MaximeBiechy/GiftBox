<?php 
declare(strict_types=1);

namespace gift\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

    // Attributs
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['libelle', 'description', 'img'];

    // Méthodes
    public function prestations() {
        return $this->hasMany('gift\appli\core\domain\entities\Prestation', 'cat_id');
    }
}


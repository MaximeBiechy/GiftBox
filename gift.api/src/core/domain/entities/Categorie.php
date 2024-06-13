<?php
namespace gift\api\core\domain\entities;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;


    function prestations()
    {
        return $this->hasMany('gift\api\core\domain\entities\Prestation', 'cat_id');
    }
}


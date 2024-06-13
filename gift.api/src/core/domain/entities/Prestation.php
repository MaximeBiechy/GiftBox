<?php
namespace gift\api\core\domain\entities;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model{
    use HasUuids;
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public $keyType = 'string';
    
    function categorie()
    {
        return $this->belongsTo('gift\api\core\domain\entities\Categorie', 'cat_id');
    }

    function box2presta(){
        return $this->belongsToMany('gift\api\core\domain\entities\Box', 'box2presta',
            'presta_id',
            'box_id'
        )->withPivot(
            ['quantite']
        );
    }
}


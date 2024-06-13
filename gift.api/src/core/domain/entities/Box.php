<?php
namespace gift\api\core\domain\entities;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Box extends Model{
    use HasUuids;
    protected $table = 'box';

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    function box2presta(){
        return $this->belongsToMany('gift\api\core\domain\entities\Prestation', 'box2presta',
            'box_id',
            'presta_id'
        )->withPivot(
            ['quantite']
        );
    }

    function createur(){
        return $this->belongsTo('gift\api\core\domain\entities\User', 'createur_id');
    }
}


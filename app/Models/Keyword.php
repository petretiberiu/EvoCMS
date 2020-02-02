<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static Keyword find($word)
 * @method static Keyword create(array $array)
 * @property string Keyword
 */
class Keyword extends Model
{
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     * @var boolean $incrementing: Cheia primara nu este autoincrementabila
     */
    protected $table = 'Keywords';
    protected $primaryKey = 'ID';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['postare_slug', 'Keyword'];

    public function postare() {
        return $this->belongsTo('App\Models\Postare');
    }
    public function categorie() {
        return $this->belongsToMany('App\Models\Categorie');
    }
}

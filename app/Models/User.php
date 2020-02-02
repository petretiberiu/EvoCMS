<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * @method static Collection select(array $columns)
 * @method static User create(array $all)
 * @method static User find($Email)
 * @property string Password
 * @property string auth_token
 */
class User extends Model
{
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     * @var boolean $timestamps: Nu foloseste timestamps
     * @var boolean $incrementing: Cheia primara nu este autoincrementabila
     */
    protected $table = 'Useri';
    protected $primaryKey = 'Email';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['Email', 'Username', 'Password', 'Tara'];

    public function comentariu() {
        return $this->hasMany('App\Models\Comentariu', 'Autor');
    }
    public function postare() {
        return $this->hasMany('App\Models\Postare', 'Autor');
    }
    public function role() {
        return $this->belongsToMany("App\Models\Role");
    }
}

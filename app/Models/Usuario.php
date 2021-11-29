<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{
    protected $table = "usuarios";

    protected $primaryKey = 'NombreUsuario';

    public $incrementing = false;

    protected $keyType = 'string';

    // protected $fillable = [];

    // public $timestamps = false;
}
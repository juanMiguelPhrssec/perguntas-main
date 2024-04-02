<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProvaparaUsuario extends Model
{
    use HasFactory;
    protected $table = "provasparausuario";
    protected $fillable = [
        'nome_aval',

        'setor_id',
        'pessoas_id',
        'empresas_id'
    ];

    public function titulodescricao() : BelongsTo
    {
        return $this->belongsTo(Tituloedescricao::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'pessoas_id');
    }
    public function setor() : BelongsTo
    {
        return $this->belongsTo(Setor::class,'setor_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setor extends Model
{
    use HasFactory;
    protected $table = "setor";
    protected $fillable = [
        'setor',
        'empresas_id'
    ];
    public function empresa():BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresas_id');
    }
    public function usuarios():HasMany
    {
        return $this->hasMany(User::class, 'setors_id');
    }
    public function provasparausuarios():HasMany
    {
        return $this->hasMany(ProvaparaUsuario::class,'setor_id');
    }
    public function respostas():HasMany
    {
        return $this->hasMany(Resposta::class, 'setor_id');
    }
}

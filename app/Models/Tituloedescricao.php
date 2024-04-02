<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tituloedescricao extends Model
{
    use HasFactory;
    protected $table = "titulosedescricao";
    protected $fillable =[
        "id",
        "titulo",
        "descricao",
        "Admin_id"
    ];
    public function perguntas():HasMany
    {
        return $this->hasMany(Pergunta::class);
    

    }
    public function provasparausuarios():HasMany
    {
        return $this->hasMany(ProvaparaUsuario::class);
    }
    public function respostas():HasMany
    {
        return $this->hasMany(Resposta::class);
    }
    
}

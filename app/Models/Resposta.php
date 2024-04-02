<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resposta extends Model
{
    use HasFactory;
    protected $table = "respostas";
    protected $fillable = [
        'respostas',
        'titulos_id',
        'perguntas_id',
        'provas_id',
        'setor_id',
        'user_id',
    ];

    public function titulo():BelongsTo
    {
        return $this->belongsTo(Tituloedescricao::class);
    }
    public function setor():BelongsTo
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pergunta():BelongsTo
    {
        return $this->belongsTo(Pergunta::class, 'provas_id');
    }
}

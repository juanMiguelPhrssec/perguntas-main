<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pergunta extends Model
{
    use HasFactory;
    protected $table = "provas";
    protected $fillable = [
        'tituloedescricao_id',
        'pergunta',
        'campo_text',
        'obs',
        'criticidade',
        'peso',
    
    ];
    public function tituloedescricao(): BelongsTo
    {
        return $this->belongsTo(Tituloedescricao::class);
        
    }
    public function respostas():HasMany
    {
        return $this->hasMany(Resposta::class, 'provas_id');
    }
}

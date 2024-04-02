<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProvaCorrigida extends Model
{
    use HasFactory;
    protected $table = "provascorrigidas";
    protected $fillable = 
    [
        'peso',
        'corrigida',
        'titulo_id',
        'perguntas_id',
        'user_id',
    ];
    public function titulo():BelongsTo
    {
        return $this->belongsTo(Tituloedescricao::class, 'titulo_id');
    }
    public function pergunta():BelongsTo
    {
        return $this->belongsTo(Pergunta::class);
    }
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

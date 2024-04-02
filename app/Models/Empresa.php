<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    use HasFactory;
    protected $table = "empresas";
    protected $fillable = [
        'nome_da_empresa',
        'cnpj',
    ];
    public function setores():HasMany
    {
        return $this->hasMany(Setor::class, 'empresas_id');
    }
    public function usuarios() :HasMany
    {
        return $this->hasMany(User::class);
    }
}

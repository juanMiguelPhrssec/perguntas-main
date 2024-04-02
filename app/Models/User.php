<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute ;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type', 
        'empresas_id',
        'setors_id',
        'status_avaliacao',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["user", "admin", "manager"][$value] ?? null,
        );
        
        
    }
    public function empresa() :BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
    public function setor():BelongsTo
    {
        return $this->belongsTo(Setor::class, 'setors_id');
    }
    public function provasparausuarios():HasMany
    {
    
        return $this->hasMany(ProvaparaUsuario::class ,'pessoas_id');
    }
    public function respostas():HasMany
    {
        return $this->hasMany(Resposta::class,'user_id');
    }
    
    
}

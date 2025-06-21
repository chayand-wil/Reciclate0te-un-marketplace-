<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Rol;


class User extends Authenticatable implements JWTSubject
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'dpi',
        'id_estado',
        'id_rol',
        'id_nivel',
        'cantidad_puntos',
        'id_municipio',
        'id_genero',
        'fecha_nacimiento',
        'detalle_direccion',
        'medio_contacto',
    ];





    // protected $appends = ['nombre_rol'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // Relación: Un usuario pertenece a un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
     
    // $rol = Rol::where('nombre', 'Ecoemprendedor')->first();
    // $usuarios = $rol->usuarios;  // Aquí se usa la relación



    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

    // public function getNombreRolAttribute()
    // {
    //     return $this->rol ? $this->rol->slug : null;
    // }



    

}
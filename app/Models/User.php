<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Personas\Empleado;
use App\Models\Personas\Persona;
use App\Models\Personas\Representante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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
    //==================================================================================
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id');
    }
    //==================================================================================
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id');
    }
    //==================================================================================
    public function representante()
    {
        return $this->belongsTo(Representante::class, 'id');
    }
    //==================================================================================
    //==================================================================================
    public function getRoles()
    {
        return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
    }
    //==================================================================================

    public function setSession()
    {
        $roles = $this->getRoleNames();
        $rolesFull = $this->getRoles();
        $rolPrincipal = $rolesFull->first();
        $nombres_completos = $this->name;
        Session::put([
            'id_usuario' => $this->id,
            'nombres_completos' => $nombres_completos,
            'rol_principal' => $rolPrincipal->name,
            'rol_principal_id' => $rolPrincipal->id,
            'roles' => $rolesFull,
            'foto' => $this->foto,
            //'cant_notificaciones' => Notificacion::where('usuario_id',$this->id)->count(),
        ]);
    }
}

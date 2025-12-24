<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'matricula',
        'tipo_usuario'
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
    public function tccsComoAluno()
    {
        return $this->hasMany(Tcc::class, 'aluno_id');
    }

    // Relação com TCCs onde o usuário é orientador
    public function tccsComoOrientador()
    {
        return $this->hasMany(Tcc::class, 'orientador_id');
    }

    public function tccs()
    {
        switch ($this->tipo_usuario) {
            case 'aluno':
                return $this->tccsComoAluno();
            case 'orientador':
                return $this->tccsComoOrientador();

        }

    }
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'autor_id');
    }
    public function isAluno()
    {
        return $this->tipo_usuario == 'aluno';
    }
    public function isOrientador()
    {
        return $this->tipo_usuario == 'orientador';
    }
    public function isAdmin()
    {
        return $this->tipo_usuario == 'admin';
    }

}

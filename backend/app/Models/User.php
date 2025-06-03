<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'surname',
        'firstname',
        'nickname',
        'email',
        'password',
        'is_mail_confirmed',
        'current_streak',
        'last_connection',
        'registration_key_id'
    ];

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
            'last_connection' => 'datetime',
            'is_mail_confirmed' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function registrationKey(){
        return $this->belongsTo(RegistrationKey::class);
    }

    public function store(){
        return $this->registrationKey ? $this->registrationKey->store() : null;
    }

    public function market(){
        return $this->store() ? $this->store()->market() : null;
    }

    public function verificationKey(){
        return $this->hasOne(VerificationKey::class);
    }

    public function testProgresses(){
        return $this->hasMany(TestProgress::class);
    }

    public function gameProgresses() {
        return $this->hasMany(GameProgress::class);
    }
}

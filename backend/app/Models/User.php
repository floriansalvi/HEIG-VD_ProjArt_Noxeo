<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\VerificationKeyMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mail;

class User extends Authenticatable implements MustVerifyEmail
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

    public function gameQuestionProgresses() {
        return $this->hasMany(GameQuestionProgress::class);
    }

    public function badges() {
        return $this->belongsToMany(Badge::class, 'badge_collections');
    }

    public function fullName() {
        return "{$this->firsname} {$this->surname}";
    }

    public function sendVerificationKey() {
        $this->verificationKey()?->delete();

        $code = random_int(100000, 999999);

        $this->verificationKey()->create(['content' => $code]);

        Mail::to($this->email)->send(new VerificationKeyMail($code));
    }
}

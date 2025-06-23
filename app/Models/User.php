<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    protected $guarded = []; //permitir guardar cualquier dato del user
    /*
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
*/
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
    
    public function getQuestion1(): string
    {
        return $this->question_1;
    }

    public function setQuestion1(string $question1): self
    {
        $this->question_1 = $question1;

        return $this;
    }

    public function getAnswer1(): string
    {
        return $this->answer_1;
    }

    public function setAnswer1(string $answer1): self
    {
        $this->answer_1 = $answer1;

        return $this;
    }

    public function getQuestion2(): string
    {
        return $this->question_2;
    }

    public function setQuestion2(string $question2): self
    {
        $this->question_2 = $question2;

        return $this;
    }

    public function getAnswer2(): string
    {
        return $this->answer_2;
    }

    public function setAnswer2(string $answer2): self
    {
        $this->answer_2 = $answer2;

        return $this;
    }
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'usuario_id');
    }
    public function practicas()
    {
        return $this->belongsToMany(practicas::class, 'practicas_usuarios');
    }
}

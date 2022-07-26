<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "id_user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'names',
        'lastnames',
        'email',
        'DNI',
        'DNI_type',
        'phone',
        'gender',
        'position',
        'number',
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function championships(){
        return $this->hasMany(Championship::class, 'id_championship');
    }

    public function teams(){
        return $this->hasMany(Team::class, 'id_team');
    }

    public function teams_as_player(){
        return $this->belongsToMany(Team::class, 'team_players', 'id_user', 'id_team')->using(TeamPlayer::class, 'id_team_player');
    }

    public function votes(){
        return $this->hasMany(Vote::class, 'id_vote');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_team';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'id_user',
    ];

    public function players()
    {
        return $this->hasMany(User::class)->using(TeamPlayer::class, 'id_team_player');
    }

    public function championship()
    {
        return $this->belongsToMany(Championship::class)->using(ChampionshipTeam::class, 'id_championship_team');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

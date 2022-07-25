<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'team_players';

    protected $primaryKey = 'id_team_player';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'id_team'
    ];

    public function team(){
        return $this->belongsTo(Team::class, 'id_team');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function votes(){
        return $this->belongsToMany(Vote::class, 'id_vote');
    }
}

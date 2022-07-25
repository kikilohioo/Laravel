<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot as RelationsPivot;

class ChampionshipTeam extends RelationsPivot
{
    use HasFactory;

    protected $table = 'championship_teams';

    protected $primaryKey = 'id_championship_team';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_team',
        'id_championship'
    ];

    public function team(){
        return $this->belongsTo(Team::class, 'id_team');
    }

    public function championship(){
        return $this->belongsTo(Championship::class, 'id_championship');
    }
}

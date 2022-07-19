<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_championship';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'departament',
        'city',
        'direction',
        'cash',
        'transfer',
        'online',
        'abitab_redpagos',
        'beach',
        'max_teams',
        'datetime',
        'group_stage',
        'competition_format',
        'sets',
        'final_sets',
        'points',
        'final_points',
        'gold_cup',
        'silver_cup',
        'bronce_cup',
        'participation_reward',
        'gender',
        'name',
        'email',
        'password',
    ];
}

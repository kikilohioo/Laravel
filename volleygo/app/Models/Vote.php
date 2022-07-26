<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_vote';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'id_championship'
    ];

    public function championship(){
        return $this->belongsTo(Championship::class, 'id_championship');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function players(){
        return $this->hasMany(TeamPlayer::class);
    }
}

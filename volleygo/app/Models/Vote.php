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

    public function championship()
    {
        return $this->belongsTo(Championship::class, 'id_championship');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function players()
    {
        return $this->hasMany(TeamPlayer::class);
    }

    public static function votes_by_user($id_user){
        return Vote::where('id_tp_cen1', $id_user)
        ->orWhere('id_tp_cen2', $id_user) 
        ->orWhere('id_tp_ops1', $id_user) 
        ->orWhere('id_tp_ops2', $id_user)
        ->orWhere('id_tp_set', $id_user)
        ->orWhere('id_tp_opo', $id_user)
        ->orWhere('id_tp_lib', $id_user)
        ->get()->toArray();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Championship;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();
        Championship::factory()->count(5)->create();
        Team::factory()->count(5)->create();
        $i = 0;
        for($i; $i < 6; $i++){
            DB::insert('INSERT INTO team_players (`id_user`,`id_team`,`created_at`,`updated_at`) VALUES(:id_user,:id_team,:created_at,:updated_at)',['id_user' => rand(1,5), 'id_team' => rand(1,5), 'created_at' => '2022-07-24 23:20:38', 'updated_at' => '2022-07-24 23:20:38']);
        }
        $j = 0;
        for($j; $j < 6; $j++){
            DB::insert('INSERT INTO championship_teams (`id_team`,`id_championship`,`created_at`,`updated_at`) VALUES(:id_team,:id_championship,:created_at,:updated_at)',['id_team' => rand(1,5), 'id_championship' => rand(1,5), 'created_at' => '2022-07-24 23:20:38', 'updated_at' => '2022-07-24 23:20:38']);
        }
    }
}

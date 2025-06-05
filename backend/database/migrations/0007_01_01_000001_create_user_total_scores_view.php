<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW user_total_scores AS
                SELECT
                    users.id AS user_id,
                    users.surname,
                    users.firstname,
                    users.nickname,
                    markets.id AS market_id,
                    markets.name AS market_name,
                    COALESCE(SUM(game_progress.score), 0) AS total_game_score,
                    COALESCE(SUM(test_progress.score), 0) AS total_test_score,
                    COALESCE(SUM(test_progress.time_bonus), 0) AS total_time_bonus,
                    COALESCE(SUM(game_progress.score), 0) 
                    + COALESCE(SUM(test_progress.score), 0) 
                    + COALESCE(SUM(test_progress.time_bonus), 0) AS total_score
                FROM users
                LEFT JOIN registration_keys ON users.registration_key_id = registration_keys.id
                LEFT JOIN stores ON registration_keys.store_id = stores.id
                LEFT JOIN markets ON stores.market_id = markets.id
                LEFT JOIN game_progress ON users.id = game_progress.user_id
                LEFT JOIN test_progress ON users.id = test_progress.user_id
                GROUP BY users.id, users.surname, users.firstname, users.nickname, markets.id;    
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS user_total_scores");
    }
};

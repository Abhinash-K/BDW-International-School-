<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getLoggedInUseByID')) {
    function getLoggedInUseByID($userId)
    {
        $sessionLifetime = config('session.lifetime');
        $cutoffTime = now()->subMinutes($sessionLifetime)->timestamp;
    
        return DB::table('sessions')
            ->where('user_id', $userId)
            ->where('last_activity', '>=', $cutoffTime)
            ->exists();
    }
}
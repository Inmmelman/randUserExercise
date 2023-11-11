<?php
namespace App\Listeners;

use App\Events\UserDataFetched;
use Illuminate\Support\Facades\Log;

class LogUserData
{
    public function handle(UserDataFetched $event)
    {
        foreach ($event->users as $user) {
            Log::info('Fetched user:', (array) $user);
        }
    }
}

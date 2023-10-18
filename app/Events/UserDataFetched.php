<?php
namespace App\Events;

use App\DTOs\UserData;
use Illuminate\Foundation\Events\Dispatchable;

class UserDataFetched
{
    use Dispatchable;

    public $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }
}

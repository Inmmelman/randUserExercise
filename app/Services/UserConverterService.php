<?php
namespace App\Services;

use App\DTOs\UserData;

class UserConverterService
{
    public function convertToArray(UserData $user): array
    {
        return $user->toArray();
    }

    public function convertMultipleToArray(array $users): array
    {
        return array_map([$this, 'convertToArray'], $users);
    }
}

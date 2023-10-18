<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Http;

class ApiUserRepository implements UserRepositoryInterface
{
    protected $apiUrl = 'https://randomuser.me/api/';

    public function fetchUsers(int $count): array
    {
        $response = Http::get($this->apiUrl, ['results' => $count]);
        return $response->json()['results'];
    }
}

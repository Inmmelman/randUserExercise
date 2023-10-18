<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\DTOs\UserData;
use Illuminate\Support\Facades\Http;

/**
 * Class ApiUserRepository
 *
 * A repository that fetches user data from the Random User API.
 *
 * @package App\Repositories
 */
class ApiUserRepository implements UserRepositoryInterface
{
    /**
     * The base URL of the Random User API.
     *
     * @var string
     */
    protected $apiUrl = 'https://randomuser.me/api/';

    /**
     * {@inheritdoc}
     */
    public function fetchUsers(int $count): array
    {
        $response = Http::get($this->apiUrl, ['results' => $count]);
        $results = $response->json()['results'];

        return array_map(function ($user) {
            return UserData::fromArray($user);
        }, $results);
    }
}

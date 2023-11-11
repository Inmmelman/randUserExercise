<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\DTOs\UserData;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class ApiUserRepository implements UserRepositoryInterface
{
    protected $apiUrl = 'https://randomuser.me/api/';

    public function fetchUsers(int $count): array
    {
        try {
            $response = Http::get($this->apiUrl, ['results' => $count]);

            // Check if the request was successful
            if (!$response->successful()) {
                throw new \RuntimeException("Failed to fetch users from Random User API. Status: {$response->status()}");
            }

            $data = $response->json();

            // Check if the expected data format is present
            if (!isset($data['results']) || !is_array($data['results'])) {
                throw new \UnexpectedValueException('Unexpected response format from Random User API');
            }

            return array_map(function ($user) {
                return UserData::fromArray($user);
            }, $data['results']);

        } catch (RequestException $e) {
            throw new \RuntimeException("Error communicating with Random User API: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new \RuntimeException("An unexpected error occurred: " . $e->getMessage());
        }
    }
}

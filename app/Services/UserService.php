<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getProcessedUsers(int $count): array
    {
        $users = $this->userRepository->fetchUsers($count);

        return collect($users)->map(function ($user) {
            return [
                'fullName' => $user['name']['title'] . ' ' . $user['name']['first'] . ' ' . $user['name']['last'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'country' => $user['location']['country']
            ];
        })->sortByDesc('fullName')->values()->all();
    }

}

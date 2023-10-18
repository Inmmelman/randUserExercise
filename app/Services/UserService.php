<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Strategies\SortStrategyInterface;

class UserService
{
    protected $userRepository;
    protected $sortStrategy;

    public function __construct(UserRepositoryInterface $userRepository, SortStrategyInterface $sortStrategy)
    {
        $this->userRepository = $userRepository;
        $this->sortStrategy = $sortStrategy;
    }

    /**
     * Retrieve, process, and return user data.
     *
     * @param int $count Number of users to fetch and process.
     * @return array An array of processed user data.
     */
    public function getProcessedUsers(int $count): array
    {
        $users = $this->userRepository->fetchUsers($count);

        return $this->sortStrategy->sort($users);
    }

}

<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Strategies\SortStrategyInterface;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $userRepository;
    protected $sortStrategy;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository The user repository instance.
     * @param SortStrategyInterface $sortStrategy The sorting strategy instance.
     */
    public function __construct(UserRepositoryInterface $userRepository, SortStrategyInterface $sortStrategy)
    {
        $this->userRepository = $userRepository;
        $this->sortStrategy = $sortStrategy;
    }

    /**
     * Set a new sorting strategy.
     *
     * @param SortStrategyInterface $sortStrategy The new sorting strategy.
     * @return void
     */
    public function setSortStrategy(SortStrategyInterface $sortStrategy): void
    {
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
        try {
            $users = $this->userRepository->fetchUsers($count);

            return $this->sortStrategy->sort($users);
        } catch (\Exception $e) {
            // Log the error
            Log::error("Error fetching or processing users: " . $e->getMessage());
            return [];
        }
    }
}

<?php
namespace App\Contracts;

/**
 * Interface UserRepositoryInterface
 *
 * Defines the contract for user data fetching repositories.
 *
 * @package App\Contracts
 */
interface UserRepositoryInterface
{
    /**
     * Fetch a specified number of user records.
     *
     * @param int $count Number of user records to fetch.
     * @return array An array of user data.
     */
    public function fetchUsers(int $count): array;
}

<?php
namespace App\Contracts;

interface UserRepositoryInterface
{
    public function fetchUsers(int $count): array;
}

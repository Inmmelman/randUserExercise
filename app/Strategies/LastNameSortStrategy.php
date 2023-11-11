<?php
namespace App\Strategies;

use App\DTOs\UserData;

class LastNameSortStrategy implements SortStrategyInterface
{
    public function sort(array $data): array
    {
        usort($data, function (UserData $a, UserData $b) {
            return strcmp($b->fullName, $a->fullName); // Reverse alphabetical order
        });

        return $data;
    }
}

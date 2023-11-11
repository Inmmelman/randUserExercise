<?php
namespace App\Strategies;

interface SortStrategyInterface
{
    public function sort(array $data): array;
}

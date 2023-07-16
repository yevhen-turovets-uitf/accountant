<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getUserByLogin(string $login): ?User;
    public function getUserByEmail(string $userEmail): ?User;
    public function saveUser(User $user): ?User;
    public function updateUser(User $user): ?User;
    public function getUserById(int $id): ?User;
    public function markUserEmail(User $user): void;
    public function findByCriteria(array $criteria): Collection;
}

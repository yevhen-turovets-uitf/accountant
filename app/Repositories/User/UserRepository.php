<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getUserByEmail(string $userEmail): ?User
    {
        $user = User::firstwhere('email', $userEmail);

        return $user;
    }

    public function saveUser(User $user): ?User
    {
        $user->save();

        return $user;
    }

    public function updateUser(User $user): ?User
    {
        $user->update();

        return $user;
    }

    public function getUserByLogin(string $login): ?User
    {
        $user = User::firstwhere('login', $login);

        return $user;
    }

    public function getUserById(int $id): ?User
    {
        $user = User::firstWhere('id', $id);

        return $user;
    }

    public function markUserEmail(User $user): void
    {
        $user->markEmailAsVerified();
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    public function findByCriteria(array $criteria): Collection
    {
        $query = User::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->get();
    }
}

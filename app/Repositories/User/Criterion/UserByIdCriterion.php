<?php

declare(strict_types=1);

namespace App\Repositories\User\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class UserByIdCriterion
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'id',
            '=',
            $this->userId
        );
    }
}

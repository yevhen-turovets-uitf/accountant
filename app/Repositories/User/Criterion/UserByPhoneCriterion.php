<?php


namespace App\Repositories\User\Criterion;


use Illuminate\Database\Eloquent\Builder;

final class UserByPhoneCriterion
{
    private int $phone;

    public function __construct(int $phone)
    {
        $this->phone = $phone;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'phone',
            $this->phone
        );
    }
}

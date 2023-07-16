<?php


namespace App\Repositories\User\Criterion;


use Illuminate\Database\Eloquent\Builder;

final class UserByEmailCriterion
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'email',
            $this->email
        );
    }
}

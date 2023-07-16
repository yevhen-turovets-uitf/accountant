<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PresenterInterface
{
    public function present(Model $model): array;
}

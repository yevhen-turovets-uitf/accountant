<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array;
}

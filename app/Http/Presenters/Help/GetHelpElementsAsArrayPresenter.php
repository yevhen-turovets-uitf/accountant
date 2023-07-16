<?php

namespace App\Http\Presenters\Help;

use App\Contracts\PresenterCollectionInterface;
use App\Models\HelpElement;
use Illuminate\Support\Collection;

class GetHelpElementsAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (HelpElement $helpElement) {
                    return $this->present($helpElement);
                }
            )
            ->all();
    }

    public function present(HelpElement $helpElement): array
    {
        return [
            'id' => $helpElement->getId(),
            'name' => $helpElement->getName(),
            'slug' => $helpElement->getSlug(),
            'description' => $helpElement->getDescription(),
        ];
    }
}

<?php

namespace App\Http\Presenters\UsefulLink;

use App\Contracts\PresenterCollectionInterface;
use App\Models\UsefulLink;
use Illuminate\Support\Collection;

class GetUsefulLinkAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (UsefulLink $usefulLink) {
                    return $this->present($usefulLink);
                }
            )
            ->all();
    }

    public function present(UsefulLink $usefulLink): array
    {
        return [
            'id' => $usefulLink->getId(),
            'title' => $usefulLink->getTitle(),
            'url' => $usefulLink->getUrl(),
        ];
    }
}

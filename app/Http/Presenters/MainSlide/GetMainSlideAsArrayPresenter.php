<?php

namespace App\Http\Presenters\MainSlide;

use App\Contracts\PresenterCollectionInterface;
use App\Models\MainSlide;
use Illuminate\Support\Collection;

class GetMainSlideAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (MainSlide $mainSlide) {
                    return $this->present($mainSlide);
                }
            )
            ->all();
    }

    public function present(MainSlide $mainSlide): array
    {
        return [
            'id' => $mainSlide->getId(),
            'title' => $mainSlide->getTitle(),
            'link' => $mainSlide->getLink(),
            'description' => $mainSlide->getDescription(),
        ];
    }
}

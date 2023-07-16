<?php

namespace App\Http\Presenters\Tag;

use App\Contracts\PresenterCollectionInterface;
use App\Models\Tag;
use Illuminate\Support\Collection;

class GetTagsAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Tag $tag) {
                    return $this->present($tag);
                }
            )
            ->all();
    }

    public function present(Tag $tag): array
    {
        $arrayTags = [
            'id' => $tag->getId(),
            'name' => $tag->getName(),
            'slug' => $tag->getSlug(),
        ];

        return $arrayTags;
    }
}

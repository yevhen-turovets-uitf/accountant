<?php

namespace App\Http\Presenters\News;

use App\Contracts\PresenterCollectionInterface;
use App\Models\News;
use Illuminate\Support\Collection;

class GetNewsAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (News $news) {
                    return $this->present($news);
                }
            )
            ->all();
    }

    public function present(News $news): array
    {
        return [
            'id' => $news->getId(),
            'slug' => $news->getSlug(),
            'title' => $news->getTitle(),
            'description' => $news->getDescription(),
            'text' => $news->getText(),
            'createdDate' => $news->getCreatedDate()->translatedFormat('d M Y'),
            'updatedDate' => $news->getUpdatedDate()->translatedFormat('d M Y'),
        ];
    }
}

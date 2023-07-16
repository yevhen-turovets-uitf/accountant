<?php

namespace App\Http\Presenters\Search;

use App\Contracts\PresenterCollectionInterface;

class GetSearchAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection($results): array
    {
        return $results->map(
            function ($result) {
                return $this->present($result);
            }
        )->all();
    }

    public function present($result): array
    {
        $model = get_class($result);
        return [
            'title' => $result->getTitle(),
            'slug' => $result->getSlug(),
            'createdAt' => $result->getCreatedDate()->isoFormat('DD MMM YYYY', 'ru'),
            'routeName' => $model::DETAIL_ROUTE_NAME,
        ];
    }
}

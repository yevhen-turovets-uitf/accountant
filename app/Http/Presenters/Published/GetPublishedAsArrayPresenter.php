<?php

namespace App\Http\Presenters\Published;

use App\Contracts\PresenterCollectionInterface;
use App\Models\PublishedOnSite;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class GetPublishedAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (PublishedOnSite $published) {
                    return $this->present($published);
                }
            )
            ->all();
    }

    public function present(PublishedOnSite $published): array
    {
        return [
            'id' => $published->getId(),
            'date' => Carbon::parse($published->getDate())->isoFormat('DD MMM YYYY', 'ru'),
            'title' => $published->getTitle(),
            'url' => $published->getUrl(),
        ];
    }
}

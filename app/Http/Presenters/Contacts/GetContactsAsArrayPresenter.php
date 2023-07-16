<?php

namespace App\Http\Presenters\Contacts;

use App\Contracts\PresenterCollectionInterface;
use App\Models\FeedbackInfo;
use Illuminate\Support\Collection;

class GetContactsAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (FeedbackInfo $feedbackInfo) {
                    return $this->present($feedbackInfo);
                }
            )
            ->all();
    }

    public function present(FeedbackInfo $feedbackInfo): array
    {
        return [
            'id' => $feedbackInfo->getId(),
            'description' => $feedbackInfo->getDescription(),
            'map' => $feedbackInfo->getMap(),
        ];
    }
}

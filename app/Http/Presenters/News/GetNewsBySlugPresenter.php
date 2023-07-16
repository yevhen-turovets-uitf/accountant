<?php

namespace App\Http\Presenters\News;

use App\Contracts\PresenterInterface;
use App\Http\Presenters\Tag\GetTagsAsArrayPresenter;
use Illuminate\Database\Eloquent\Model;

class GetNewsBySlugPresenter implements PresenterInterface
{
    private GetTagsAsArrayPresenter $getTagsAsArrayPresenter;

    public function __construct(GetTagsAsArrayPresenter $getTagsAsArrayPresenter)
    {
        $this->getTagsAsArrayPresenter = $getTagsAsArrayPresenter;
    }

    public function present(Model $model): array
    {
        $arrayNews = [
            'title' => $model->getTitle(),
            'text' => $model->getText(),
            'createdDate' => $model->getCreatedDate()->translatedFormat('d M Y'),
            'tags' => $this->getTagsAsArrayPresenter->presentCollection($model->tags),
        ];

        return $arrayNews;
    }
}

<?php

namespace App\Http\Presenters\Handbook;

use App\Contracts\PresenterInterface;
use Illuminate\Database\Eloquent\Model;

class GetHandbookBySlugPresenter implements PresenterInterface
{
    public function present(Model $model): array
    {
        return [
            'title' => $model->getTitle(),
            'slug' => $model->getSlug(),
            'createdDate' => $model->getCreatedDate()->translatedFormat('d M Y'),
        ];
    }
}

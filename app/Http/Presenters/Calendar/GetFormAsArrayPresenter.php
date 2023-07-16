<?php

namespace App\Http\Presenters\Calendar;

use App\Contracts\PresenterCollectionInterface;
use App\Models\Form;
use Illuminate\Support\Collection;

class GetFormAsArrayPresenter implements PresenterCollectionInterface
{
    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Form $form) {
                    return $this->present($form);
                }
            )
            ->all();
    }

    public function present(Form $form): array
    {
        return [
            'id' => $form->getId(),
            'title' => $form->getTitle(),
            'link' => $form->getLink(),
        ];
    }
}

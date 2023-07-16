<?php

namespace App\Http\Presenters\Help;

use App\Contracts\PresenterCollectionInterface;
use App\Http\Presenters\Help\GetHelpElementsAsArrayPresenter;
use App\Models\HelpCategory;
use Illuminate\Support\Collection;

class GetHelpCategoriesAsArrayPresenter implements PresenterCollectionInterface
{
    public function __construct(
        private GetHelpElementsAsArrayPresenter $helpElementsAsArrayPresenter
    ){}

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (HelpCategory $helpCategory) {
                    return $this->present($helpCategory);
                }
            )
            ->all();
    }

    public function present(HelpCategory $helpCategory): array
    {
        return [
            'id' => $helpCategory->getId(),
            'name' => $helpCategory->getName(),
            'helpElements' => $this->helpElementsAsArrayPresenter->presentCollection($helpCategory->helpElements()->get()),
        ];
    }
}

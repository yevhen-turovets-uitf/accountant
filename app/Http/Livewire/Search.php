<?php

namespace App\Http\Livewire;

use App\Constants\SearchConstant;
use App\Http\Presenters\Search\GetSearchAsArrayPresenter;
use App\Http\Requests\Search\CreateSearchValidateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Handbook;
use App\Models\Consultation;
use App\Models\Blank;
use App\Models\News;

class Search extends Component
{
    public $search;
    public $results;
    public $success = false;

    protected function rules() {
        $request = new CreateSearchValidateRequest();

        return $request->rules();
    }

    public function mount(
        Request $request,
        GetSearchAsArrayPresenter $searchAsArrayPresenter,
    ): void
    {
        $this->search = $request->query('search');

        $this->results = $searchAsArrayPresenter->presentCollection(self::getSearchResults($this->search));

    }

    public function sendForm(
        GetSearchAsArrayPresenter $searchAsArrayPresenter,
    ): void
    {
        $this->validate();

        $this->results = $searchAsArrayPresenter->presentCollection(self::getSearchResults($this->search));
    }

    public function getSearchResults($searchText): ?Collection
    {
        $this->search = $searchText;
        $this->results = collect();

        if ($this->search) {
            $models = SearchConstant::MODELS;
            $searchFields = SearchConstant::SEARCH_FIELDS;

            foreach ($models as $model) {
                $this->results = $this->results->merge(
                    $model::where(function($query) use ($searchFields, $model) {
                        foreach ($searchFields[$model] as $field) {
                            $query->orWhere($field, 'like', '%'.$this->search.'%');
                        }
                    })
                        ->orderBy('created_at')
                        ->get()
                );
            }

            return $this->results->sortBy('created_at');
        }
    }

    public function render()
    {
        return view('livewire.pages.search');
    }
}

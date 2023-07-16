<?php

namespace App\Http\Livewire;

use App\Models\Blank;
use App\Models\Consultation;
use App\Models\Favorite;
use App\Models\Handbook;
use App\Models\News;
use App\Models\Norm;
use App\Models\Report;
use App\Models\TaxSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailPageWithTabs extends Component
{
    public $slug;
    public $hasAccess;
    public $model;
    public $modelRedaction;
    public $detail;
    public $date;
    public $description;
    public $titles;
    public $redactions;
    public $files;
    public $tags;
    public $openedTab;
    public array $activeSpoilers;
    public $changes;
    public $news;
    public $handbooks;
    public $taxSystems;
    public $reports;
    public $blanks;
    public $consultations;
    public $norms;
    public $favorite;
    public $pagePath;

    public function mount(
        $slug,
        $model,
        $modelRedaction,
        Request $request
    ): void
    {
        $this->hasAccess = Auth::user()->isActiveStatus();

        if($this->hasAccess) {
            $this->slug = $slug;
            $this->model = $model;
            $this->modelRedaction = $modelRedaction;
            $this->activeSpoilers = [];

            $modelElement = $this->model::query()->where('slug', $this->slug)->first();
            $this->detail = $modelElement;

            $this->tags = $modelElement->tags()->get();
            $this->tagsIds = $this->tags->pluck('id')->toArray();
            self::changeTags($this->tagsIds);

            $this->redactions = $modelElement->redactions()?->orderByDesc('date')->get();

            if($request->input('redaction')) {
                if($modelElement->redactions()->get()->contains('id', $request->input('redaction'))) {
                    $redaction = $modelElement->redactions()->get()->where('id', $request->input('redaction'))->first();

                    $this->date = $redaction->getDate();
                    $this->description = $redaction->getDescription();
                    $this->titles = $redaction->redactionTitles()->get();
                    $this->files = $redaction->files()->get();
                }
            } else {
                if($modelElement->redactions()->count()) {
                    $this->date = $modelElement->lastRedaction()->getDate();
                    $this->description = $modelElement->lastRedaction()->getDescription();
                    $this->titles = $modelElement->lastRedaction()->redactionTitles()->get();
                    $this->files = $modelElement->lastRedaction()->files()->get();
                }
            }

            $this->pagePath = '/' . $request->path();
            $this->favorite = Favorite::query()->where([
                ['user_id', Auth::user()->id],
                ['url', $this->pagePath]
            ])->first();
        } else {
            $modelElement = $model::query()->select('title')->where('slug', $slug)->first();
            $this->detail = $modelElement;
        }
    }

    public function favorites() {
        if($this->favorite) {
            $this->favorite->delete();
            $this->favorite = false;
        } else {
            $this->favorite = Favorite::create([
                'user_id' => Auth::user()->id,
                'title' => $this->detail->getTitle(),
                'url' => $this->pagePath
            ]);
        }
    }

    public function changeRedaction(int $id) {
        $this->openedTab = '';

        $redaction = $this->modelRedaction::query()->findOrFail($id);
        $this->date = $redaction->getDate();
        $this->description = $redaction->getDescription();
        $this->titles = $redaction->redactionTitles()->get();
        $this->files = $redaction->files()->get();
    }

    public function changeTags(array $ids) {
        $this->activeSpoilers = [
            'news',
            'handbooks',
            'tax-systems',
            'reports',
            'blanks',
            'consultations',
            'norms',
        ];

        $this->news = News::whereHas('tags', function($query) use ($ids) {
            $query->whereIn('tags.id', $ids);
        })->with('tags')->get();
        $this->handbooks = Handbook::whereHas('tags', function($query) use ($ids) {
            $query->whereIn('tags.id', $ids);
        })->with('tags')->get();
        $this->taxSystems = TaxSystem::whereHas('tags', function($query) use ($ids) {
            $query->whereIn('tags.id', $ids);
        })->with('tags')->get();
        $this->reports = Report::whereHas('tags', function($query) use ($ids) {
            $query->whereIn('tags.id', $ids);
        })->with('tags')->get();
        $this->blanks = Blank::whereHas('tags', function($query) use ($ids) {
            $query->whereIn('tags.id', $ids);
        })->with('tags')->get();
        $this->consultations = Consultation::whereHas('tags', function($query) use ($ids) {
            $query->whereIn('tags.id', $ids);
        })->with('tags')->get();
        $this->norms = Norm::whereHas('tags', function($query) use ($ids) {
            $query->whereIn('tags.id', $ids);
        })->with('tags')->get();
    }

    public function addTag(int $id) {
        $this->openedTab = 'connections';

        array_push($this->tagsIds, $id);
        self::changeTags($this->tagsIds);
    }

    public function removeTag(int $id) {
        $this->openedTab = 'connections';

        $index = array_search($id, $this->tagsIds);
        if ($index !== false) {
            unset($this->tagsIds[$index]);
            self::changeTags($this->tagsIds);
        }
    }

    public function setAllTags() {
        $this->openedTab = 'connections';

        $this->tags = $this->detail->tags()->get();
        $this->tagsIds = $this->tags->pluck('id')->toArray();
        self::changeTags($this->tagsIds);
    }

    public function removeAllTags() {
        $this->openedTab = 'connections';

        $this->tagsIds = [];
        self::changeTags($this->tagsIds);
    }

    public function openSpoiler(string $spoilerName) {
        if(in_array($spoilerName, $this->activeSpoilers)) {
            unset($this->activeSpoilers[array_search($spoilerName, $this->activeSpoilers)]);
        } else {
            $this->activeSpoilers[] = $spoilerName;
        }
    }

    public function render()
    {
        return view('livewire.pages.detail-page-with-tabs');
    }
}

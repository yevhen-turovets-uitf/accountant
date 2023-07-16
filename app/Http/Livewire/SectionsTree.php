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
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;

class SectionsTree extends Component
{
    public $model;
    public $detailPageRouteName;
    public $detailModel;
    public $detailModelRedaction;
    public $sectionTree;
    public $sectionsHtml;
    public $sectionTitle;
    public $sectionElements;
    public $showDetailPage = false;
    public $slug;
    public $hasAccess;
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
    public $currentSection = null;
    public $currentSectionsList;


    public function mount($model, $detailPageRouteName, $detailModel, $detailModelRedaction, Request $request): void
    {
        $this->model = $model;
        $this->detailPageRouteName = $detailPageRouteName;
        $this->detailModel = $detailModel;
        $this->detailModelRedaction = $detailModelRedaction;
        $this->currentSection = $request->get('section');

        $sections = $this->model::with('childrenElements')
            ->orderBy('id')
            ->get()
            ->toArray();

        foreach ($sections as &$section) {
            $section['elements'] = $section['children_elements'];
            unset($section['children_elements']);
        }

        $this->sectionTree = $this->buildTree($sections);
        $this->currentSectionsList = $this->findAllParentIds($this->sectionTree, (int)$this->currentSection);
        $this->sectionsHtml = $this->generateHTML($this->sectionTree, $request);

        if($request->get('element')) {
            $this->showDetailPage((int)$request->get('element'), $request);
        }
    }

    function findSectionById($sections, $id)
    {
        foreach ($sections as $section) {
            if ($section['id'] === $id) {
                return $section;
            }

            if (!empty($section['children'])) {
                $foundSection = $this->findSectionById($section['children'], $id);

                if ($foundSection !== null) {
                    return $foundSection;
                }
            }
        }

        return null;
    }

    function findAllParentIds($sections, $id)
    {
        $section = $this->findSectionById($sections, $id);

        if ($section !== null) {
            $parentIds = [];

            while ($section['category_id'] !== null) {
                $parentIds[] = $section['category_id'];
                $section = $this->findSectionById($sections, $section['category_id']);
            }

            return $parentIds;
        }

        return [];
    }

    function buildTree(array $sections, $parentId = null) {
        $branch = array();
        foreach ($sections as $section) {
            if ($section['category_id'] == $parentId) {
                $children = $this->buildTree($sections, $section['id']);
                if ($children) {
                    $section['children'] = $children;
                }
                $branch[] = $section;
            }
        }

        return $branch;
    }

    public function generateHTML(array $sections, Request $request) {
        $html = '<ul>';
        foreach ($sections as $section) {
            $html .= '<li><div class="tree__item ' . ( ((int)$this->currentSection == $section['id'] || in_array($section['id'], $this->currentSectionsList) ) ? 'active' : '') . '"><div class="tree__item__wrap tree__for" data-for="' . $section['id'] . '">';
            if(array_key_exists('children', $section)) {
                $html .= '<i class="far fa-plus-square"></i><i class="far fa-minus-square"></i><span>' . $section['name'] . '</span>';
            } elseif (array_key_exists('elements', $section)) {
                $html .= '<i class="far fa-plus-square"></i><i class="far fa-minus-square"></i><span>' . $section['name'] . '</span>';
            }
            $html .= '</div>';

            if (isset($section['children'])) {
                $html .= $this->generateHTML($section['children'], $request);
            } else if (count($section['elements'])) {
                $html .= '<ul>';
                foreach($section['elements'] as $element) {
                    $html .= '<li><div class="tree__item"><div class="tree__item__wrap element__for' . (($request->get('element') == $element['id']) ? ' active' : '') . '" data-for="' . $element['id'] . '"><span wire:click.prevent="showDetailPage(' . $element['id'] . ')">' . $element['title'] . '</span></div></div></li>';
                }
                $html .= '</ul>';
            } else {
                $html .= '<ul><li><span>Список элементов пуст.</span></li></ul>';
            }

            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function showDetailPage(int $id, Request $request) {
        $this->showDetailPage = true;

        $element = $this->detailModel::find($id);
        if ($element) {
            $slug = $element->slug;
        }
        $model = $this->detailModel;
        $modelRedaction = $this->detailModelRedaction;

        $this->hasAccess = Auth::user()?->isActiveStatus();

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

    public function loadElements(int $id) {
        $section = $this->model::find($id);
        $this->sectionTitle = $section->getName();
        $this->sectionElements = $section->childrenElements()->get();
    }

    public function render()
    {
        return view('livewire.pages.sections-tree');
    }
}

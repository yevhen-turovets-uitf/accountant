<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SectionDetail extends Component
{
    public $section;
    public $sectionName;
    public $next_level_categories;
    private $elements;
    public $detailPageRouteName;
    public $sectionPageRouteName;
    public $pageTitle;
    public $pageRoute;
    public $parentCategories;

    public $page = 1;
    public $perPage = 9;

    public function mount(
        $slug,
        $model,
        $detailPageRouteName,
        $sectionPageRouteName,
        $pageTitle,
        $pageRoute,
    ): void
    {
        $this->page = 1;

        $this->detailPageRouteName = $detailPageRouteName;
        $this->sectionPageRouteName = $sectionPageRouteName;
        $this->pageTitle = $pageTitle;
        $this->pageRoute = $pageRoute;

        $this->section = $model::query()->where('slug', $slug)->first();
        $this->sectionName = $this->section->name;
        if($this->section->categories()->count()) {
            $this->next_level_categories = $this->section->categories()->get();
        } else {
            $this->elements = $this->section->childrenElements()->paginate($this->perPage);
        }

        $this->parentCategories = $this->getParentCategories($this->section);
    }

    public function getParentCategories($section, &$parentCategories = [])
    {
        if ($section->parentCategory) {
            array_unshift($parentCategories, $section->parentCategory);
            $this->getParentCategories($section->parentCategory, $parentCategories);
        }

        return $parentCategories;
    }

    public function render()
    {
        return view('livewire.pages.section-detail', [
            'elements' => $this->elements
        ]);
    }
}

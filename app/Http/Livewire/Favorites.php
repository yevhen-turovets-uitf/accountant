<?php

namespace App\Http\Livewire;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Favorites extends Component
{
    public $favorites;

    public function mount(): void
    {
        $this->favorites = Auth::user()->favorites()->get();
    }

    public function removeFavorite($id) {
        if(Favorite::find($id)->user_id != Auth::user()->id) {
            session()->flash('error', __('favorites.not_your_favorite'));
        } else {
            Favorite::find($id)->delete();
            $this->favorites = Auth::user()->favorites()->get();
        }
    }

    public function render()
    {
        return view('livewire.pages.favorites');
    }
}

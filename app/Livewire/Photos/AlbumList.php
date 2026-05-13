<?php

namespace App\Livewire\Photos;

use App\Models\PhotoAlbum;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.gallery')]
#[Title('Galerie photos — Concours FVSP 2026')]
class AlbumList extends Component
{
    public function render()
    {
        $albums = PhotoAlbum::active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->withCount('photos')
            ->with(['photos' => fn($q) => $q->limit(1)->with('media')])
            ->get();

        return view('livewire.photos.album-list', compact('albums'));
    }
}

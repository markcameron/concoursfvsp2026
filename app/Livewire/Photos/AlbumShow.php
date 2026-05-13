<?php

namespace App\Livewire\Photos;

use App\Models\PhotoAlbum;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.gallery')]
class AlbumShow extends Component
{
    public PhotoAlbum $album;

    public function mount(PhotoAlbum $album): void
    {
        abort_unless($album->active, 404);
    }

    #[Title('')]
    public function render()
    {
        $photos = $this->album->photos()->with('media')->get();

        return view('livewire.photos.album-show', compact('photos'))
            ->title($this->album->title . ' — Galerie photos');
    }
}

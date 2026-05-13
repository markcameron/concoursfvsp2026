<?php

namespace App\Livewire\Photos;

use App\Models\Photo;
use App\Models\PhotoAlbum;
use App\Models\PhotoVote;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.gallery')]
class PhotoShow extends Component
{
    private const VISITOR_COOKIE = 'gallery_visitor_id';

    private const VISITOR_COOKIE_TTL = 60 * 24 * 365;

    public PhotoAlbum $album;

    public Photo $photo;

    public ?string $userVote = null;

    public int $upvotes = 0;

    public int $downvotes = 0;

    public function mount(PhotoAlbum $album, Photo $photo): void
    {
        abort_unless($photo->photo_album_id === $album->id, 404);

        $photo->increment('display_count');

        $this->photo = $photo->fresh(['media']);

        $votes = $photo->withoutRelations()->newQuery()
            ->where('id', $photo->id)
            ->withCount([
                'votes as upvotes_count' => fn($q) => $q->where('vote', 'up'),
                'votes as downvotes_count' => fn($q) => $q->where('vote', 'down'),
            ])
            ->first();

        $this->upvotes = $votes->upvotes_count ?? 0;
        $this->downvotes = $votes->downvotes_count ?? 0;

        $visitorId = $this->resolveVisitorId();

        $this->userVote = PhotoVote::where('photo_id', $photo->id)
            ->where('visitor_id', $visitorId)
            ->value('vote');
    }

    public function vote(string $type): void
    {
        abort_unless(in_array($type, ['up', 'down']), 422);

        $visitorId = $this->resolveVisitorId();

        PhotoVote::updateOrCreate(
            ['photo_id' => $this->photo->id, 'visitor_id' => $visitorId],
            ['ip_address' => request()->ip(), 'vote' => $type],
        );

        $this->userVote = $type;

        $votes = $this->photo->newQuery()
            ->where('id', $this->photo->id)
            ->withCount([
                'votes as upvotes_count' => fn($q) => $q->where('vote', 'up'),
                'votes as downvotes_count' => fn($q) => $q->where('vote', 'down'),
            ])
            ->first();

        $this->upvotes = $votes->upvotes_count ?? 0;
        $this->downvotes = $votes->downvotes_count ?? 0;
    }

    public function render()
    {
        $prevPhoto = $this->album->photos()
            ->where(fn($q) => $q->where('sort_order', '<', $this->photo->sort_order)
                ->orWhere(fn($q) => $q->where('sort_order', $this->photo->sort_order)->where('id', '<', $this->photo->id)))
            ->orderByDesc('sort_order')
            ->orderByDesc('id')
            ->first();

        $nextPhoto = $this->album->photos()
            ->where(fn($q) => $q->where('sort_order', '>', $this->photo->sort_order)
                ->orWhere(fn($q) => $q->where('sort_order', $this->photo->sort_order)->where('id', '>', $this->photo->id)))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        return view('livewire.photos.photo-show', compact('prevPhoto', 'nextPhoto'))
            ->title(($this->photo->title ?? 'Photo') . ' — ' . $this->album->title);
    }

    private function resolveVisitorId(): string
    {
        $visitorId = request()->cookie(self::VISITOR_COOKIE);

        if (! $visitorId) {
            $visitorId = (string) Str::uuid();
            Cookie::queue(self::VISITOR_COOKIE, $visitorId, self::VISITOR_COOKIE_TTL);
        }

        return $visitorId;
    }
}

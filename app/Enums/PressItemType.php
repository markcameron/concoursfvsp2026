<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PressItemType: string implements HasColor, HasIcon, HasLabel
{
    case Article = 'article';
    case Video = 'video';
    case Social = 'social';
    case Website = 'website';

    public function getLabel(): string
    {
        return match ($this) {
            self::Article => 'Article',
            self::Video => 'Vidéo',
            self::Social => 'Réseaux sociaux',
            self::Website => 'Site web',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Article => 'info',
            self::Video => 'danger',
            self::Social => 'warning',
            self::Website => 'success',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Article => 'heroicon-o-newspaper',
            self::Video => 'heroicon-o-play-circle',
            self::Social => 'heroicon-o-chat-bubble-left-right',
            self::Website => 'heroicon-o-globe-alt',
        };
    }
}

<?php

namespace App\Filament\Resources\TilPostResource\Pages;

use App\Filament\Resources\TilPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTilPosts extends ListRecords
{
    protected static string $resource = TilPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

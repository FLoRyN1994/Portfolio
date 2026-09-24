<?php

namespace App\Filament\Resources\TilPostResource\Pages;

use App\Filament\Resources\TilPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTilPost extends EditRecord
{
    protected static string $resource = TilPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ListingResource\Pages;

use App\Filament\Resources\ListingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateListing extends CreateRecord
{
    protected static string $resource = ListingResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['host_id'] = auth()->id();
 
    return $data;
}
}

<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['email_verified_at'] = Carbon::now();
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {

         /** @var \App\Models\User $user */
        $user = parent::handleRecordCreation($data);
        $user->assignRole('admin');
        return $user;
    }
}

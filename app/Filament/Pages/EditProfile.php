<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.pages.edit-profile';
    protected static ?string $title = 'Edit Profile';
    protected static ?string $navigationLabel = 'Edit Profile';
    protected static ?string $slug = 'edit-profile';
    public static function shouldRegisterNavigation(): bool
    {
        return false; // Menu tidak akan muncul di sidebar
    }


    public static function getNavigationGroup(): ?string
    {
        return 'Profile';
    }

    public ?array $data = [];
    public function mount(): void
    {
        $this->form->fill([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'avatar' => Auth::user()->avatar
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->unique(User::class, 'email', ignoreRecord: true),

                FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->disk('public')
                    ->directory('avatars'),

                TextInput::make('current_password')
                    ->password()
                    ->required()
                    ->label('Current Password')
                    ->dehydrated(false),

                TextInput::make('new_password')
                    ->password()
                    ->required()
                    ->label('New Password')
                    ->dehydrated(false),

                TextInput::make('new_password_confirmation')
                    ->password()
                    ->required()
                    ->label('Confirm New Password')
                    ->dehydrated(false),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $user = Auth::user();

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['avatar'])) {
            $updateData['avatar'] = $data['avatar'];
        }

        if (!empty($data['new_password'])) {
            if (!Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Current Password does not match')
                    ->danger()
                    ->send();
                return;
            }

            $updateData['password'] = Hash::make($data['new_password']);
        }

        $user->update($updateData);

        Notification::make()
            ->title('Profile Updated')
            ->success()
            ->send();
    }
}

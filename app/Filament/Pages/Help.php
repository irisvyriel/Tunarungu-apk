<?php

namespace App\Filament\Pages;

use App\Models\Pengaturan;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Help extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.help';

    protected static ?int $navigationSort = 8;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(
            Pengaturan::where('kode', 'help')->first()->attributesToArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('audio')
                    ->visibility('public')
                    ->maxSize(10240 * 3)
                    ->required(fn($record) => $record === null)
                    ->enableOpen()
                    ->enableDownload(),
            ])
            ->statePath('data')
            ->model(Pengaturan::class);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('Update')
                ->color('primary')
                ->submit('Update'),
        ];
    }

    public function update()
    {
        Pengaturan::where('kode', 'help')->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('Help berhasil diperbarui')
            ->success()
            ->send();
    }
}

<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Table;
use Filament\Tables\Columns\ViewColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action as TableAction;
use Filament\Notifications\Notification;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $recordTitleAttribute = 'path';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('path')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('image')
                    ->view('filament.columns.image-url-column')
                    ->label('Image')
                    ->getStateUsing(fn($record) => '/storage/' . $record->path),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                TableAction::make('setPrimary')
                    ->label('Set Primary')
                    ->action(function ($record) {
                        // unset primary for other images of this product
                        $record->product->images()->update(['is_primary' => false]);
                        $record->update(['is_primary' => true]);
                        Notification::make()
                            ->success()
                            ->title('Primary image set')
                            ->send();
                    })
                    ->visible(fn ($record) => ! $record->is_primary),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

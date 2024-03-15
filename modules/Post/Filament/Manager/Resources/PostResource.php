<?php

declare(strict_types=1);

namespace Modules\Post\Filament\Manager\Resources;

use Exception;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Modules\Support\Enums\V1\LanguageList\LanguageList;
use Modules\Post\Filament\Manager\Resources\PostResource\Pages;
use Modules\Support\Enums\V1\Status\Status;

class PostResource extends Resource
{
    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getModel(): string
    {
        return post()->getMorphClass();
    }

    public static function getModelLabel(): string
    {
        return __('post::filament.manager.post.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('post::filament.manager.post.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(24)
            ->schema([
                Grid::make()
                    ->columnSpan([
                        'sm'  => 24,
                        'xl'  => 16,
                        '2xl' => 16,
                    ])
                    ->schema([
                        Section::make()
                            ->columns(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('post::filament.manager.post.inputs.title.label'))
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Get $get, Set $set, ?string $state) => null === $get('slug') ? $set('slug', Str::slug($state)) : false)
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('slug')
                                    ->label(__('post::filament.manager.post.inputs.slug.label'))
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->required()
                                    ->unique(ignorable: fn ($record) => $record)
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label(__('post::filament.manager.post.inputs.description.label'))
                                    ->columnSpanFull(),
                                TiptapEditor::make('content')
                                    ->tools([
                                        'heading', 'bullet-list', 'ordered-list', 'blockquote', 'hr',
                                        'bold', 'italic', 'strike', 'underline', 'small', 'align-left', 'align-center', 'align-right',
                                        'link', 'media', 'oembed', 'table', 'details', 'code', 'code-block', 'source',])
                                    ->extraInputAttributes(['style' => 'min-height: 12rem;height:30rem'])
                                    ->label(__('post::filament.manager.post.inputs.content.label'))
                                    ->columnSpanFull()
                                    ->required(),
                            ])
                    ]),
                Grid::make()
                    ->columnSpan([
                        'sm'  => 24,
                        'xl'  => 8,
                        '2xl' => 8,
                    ])
                    ->schema([
                        Section::make()
                            ->schema([
                                FileUpload::make('cover_url')
                                    ->label(__('post::filament.manager.post.inputs.cover_url.label'))
                            ]),
                        Section::make()
                            ->columns(1)
                            ->schema([
                                Radio::make('status')
                                    ->options(Status::pairs())
                                    ->default(Status::Active)
                                    ->inlineLabel()
                                    ->label(__('post::filament.manager.post.inputs.status.label'))
                                    ->required(),
                                DateTimePicker::make('published_at')
                                    ->label(__('post::filament.manager.post.inputs.published_at.label'))
                                    ->native(false)
                                    ->default(now())
                                    ->closeOnDateSelection()
                                    ->required(),
                                Select::make('user_id')
                                    ->label(__('post::filament.manager.post.inputs.user_id.label'))
                                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                                    ->relationship('user', 'name')->preload()
                                    ->searchable()
                                    ->default(auth()->user()?->id)
                                    ->required(),
                                Select::make('language')
                                    ->options(LanguageList::pairs())
                                    ->searchable()
                                    ->label(__('post::filament.manager.post.inputs.lang.label'))
                                    ->required(),
                                TextInput::make('cache_ttl')
                                    ->label(__('post::filament.manager.post.inputs.cache_ttl.label'))
                                    ->integer()
                                    ->default(60)
                                    ->helperText(__('post::filament.manager.post.inputs.cache_ttl.help'))
                            ])
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('post::filament.manager.post.table.th.title'))
                    ->searchable(),

                TextColumn::make('slug')
                    ->label(__('post::filament.manager.post.table.th.slug'))
                    ->color(Color::Blue)
                    ->limit(20)
                    ->tooltip(fn ($state) => $state)
                    ->searchable(),

                TextColumn::make('published_at')
                    ->label(__('post::filament.manager.post.table.th.published_at'))
                    ->badge()
                    ->color(Color::Cyan),

                TextColumn::make('language')
                    ->label(__('post::filament.manager.post.table.th.lang'))
                    ->formatStateUsing(fn ($state): string => $state->name)
                    ->badge()
                    ->color(Color::Gray),

                TextColumn::make('status')
                    ->label(__('post::filament.manager.post.table.th.status'))
                    ->sortable()
                    ->color(fn ($state) => $state->color())
                    ->formatStateUsing(fn ($state) => $state->trans())
                    ->badge(true),

            ])
            ->actions(self::getTableActions())
            ->bulkActions(self::getBulkActions())
            ->emptyStateActions(self::getEmptyStateActions())
            ->filters(self::getFilters());
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('title'),
                Infolists\Components\TextEntry::make('slug'),
                Infolists\Components\ImageEntry::make('cover_url'),
                Infolists\Components\TextEntry::make('published_at')->dateTime(),
                Infolists\Components\TextEntry::make('content')->html()
                    ->columnSpanFull(),
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title'];
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit')
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }


    private static function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\ForceDeleteAction::make(),
            Tables\Actions\RestoreAction::make(),
        ];
    }

    private static function getBulkActions(): array
    {
        return [
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]),
        ];
    }

    private static function getEmptyStateActions(): array
    {
        return [
            Tables\Actions\CreateAction::make(),
        ];
    }


    private static function getFilters(): array
    {
        try {
            return [
                Tables\Filters\TrashedFilter::make(),
            ];
        } catch (Exception $e) {
            return [];
        }

    }


}

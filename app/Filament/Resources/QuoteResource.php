<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteResource\Pages;
use App\Models\Quote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationGroup = 'Inquiries';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('company')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Project Details')
                    ->schema([
                        Forms\Components\Select::make('project_type')
                            ->options([
                                'website' => 'Website',
                                'web_app' => 'Web Application',
                                'mobile_app' => 'Mobile Application',
                                'e_commerce' => 'E-Commerce',
                                'api' => 'API Development',
                                'consulting' => 'Consulting',
                                'other' => 'Other',
                            ]),

                        Forms\Components\Select::make('budget_range')
                            ->options([
                                'under_1k' => 'Under $1,000',
                                '1k_5k' => '$1,000 - $5,000',
                                '5k_10k' => '$5,000 - $10,000',
                                '10k_25k' => '$10,000 - $25,000',
                                '25k_plus' => '$25,000+',
                                'not_sure' => 'Not Sure',
                            ]),

                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Admin')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                                'rejected' => 'Rejected',
                            ])
                            ->default('new')
                            ->required(),

                        Forms\Components\Textarea::make('notes')
                            ->rows(3)
                            ->placeholder('Internal notes about this inquiry...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('project_type')
                    ->badge(),

                Tables\Columns\TextColumn::make('budget_range')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'contacted' => 'info',
                        'in_progress' => 'primary',
                        'completed' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'rejected' => 'Rejected',
                    ]),
                Tables\Filters\SelectFilter::make('project_type')
                    ->options([
                        'website' => 'Website',
                        'web_app' => 'Web Application',
                        'mobile_app' => 'Mobile Application',
                        'e_commerce' => 'E-Commerce',
                        'api' => 'API Development',
                        'consulting' => 'Consulting',
                        'other' => 'Other',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuotes::route('/'),
            'view' => Pages\ViewQuote::route('/{record}'),
            'edit' => Pages\EditQuote::route('/{record}/edit'),
        ];
    }
}

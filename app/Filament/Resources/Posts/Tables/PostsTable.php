<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Filament\Resources\Posts\PostResource;
use Filament\Tables;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_path')
                    ->label(' ')
                    ->size(48)
                    ->square()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('provider.name')
                    ->label('Provider')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Category'),

                Tables\Filters\SelectFilter::make('provider')
                    ->relationship('provider', 'name')
                    ->label('Provider'),

                Tables\Filters\TernaryFilter::make('is_published_only')
                    ->label('Published')
                    ->placeholder('All')
                    ->trueLabel('Only published')
                    ->falseLabel('Only draft')
                    ->queries(
                        true: fn ($q) => $q->where('status', 'published'),
                        false: fn ($q) => $q->where('status', 'draft'),
                        blank: fn ($q) => $q,
                    ),
            ])
            ->recordUrl(fn ($record) => PostResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('published_at', 'desc');
    }
}

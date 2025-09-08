<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    if (! $get('slug')) {
                        $set('slug', Str::slug($state));
                    }
                }),

            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(table: 'posts', column: 'slug', ignoreRecord: true),

            Forms\Components\Textarea::make('excerpt')
                ->label('Excerpt')
                ->rows(3)
                ->maxLength(255),

            Forms\Components\RichEditor::make('body')
                ->label('Content')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'strike',
                    'h2',
                    'h3',
                    'blockquote',
                    'link',
                    'orderedList',
                    'bulletList',
                    'codeBlock',
                ])
                ->columnSpanFull(),


            Forms\Components\FileUpload::make('thumbnail_path')
                ->label('Cover Image')
                ->disk('public')
                ->directory('posts/thumbnails')
                ->visibility('public')
                ->image()
                ->imageEditor()
                ->imageResizeMode('cover')
                ->imageCropAspectRatio('16:9')
                ->openable()
                ->downloadable(),

            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->nullable(),

            Forms\Components\Select::make('provider_id')
                ->label('Provider')
                ->relationship('provider', 'name')
                ->searchable()
                ->preload()
                ->nullable(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->default('draft')
                ->reactive(),

            Forms\Components\DateTimePicker::make('published_at')
                ->label('Published At')
                ->seconds(false)
                ->native(false)
                ->visible(fn (callable $get) => $get('status') === 'published'),
        ]);
    }
}

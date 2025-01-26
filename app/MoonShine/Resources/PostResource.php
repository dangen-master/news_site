<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\MoonShine\Pages\Post\PostIndexPage;
use App\MoonShine\Pages\Post\PostFormPage;
use App\MoonShine\Pages\Post\PostDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Post, PostIndexPage, PostFormPage, PostDetailPage>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            PostIndexPage::class,
            PostFormPage::class,
            PostDetailPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            Text::make(__('moonshine::ui.resource.name'), 'title'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->sortable(),
                Text::make('Название новости', 'title')
                    ->required(),
                Textarea::make('Тело новости', 'body')
                    ->customAttributes([
                        'rows' => 10,
                    ])
                    ->required(),
            ])
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

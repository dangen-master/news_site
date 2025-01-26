<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Post;
use App\Models\User;
use App\MoonShine\Pages\Post\PostIndexPage;
use App\MoonShine\Pages\Post\PostFormPage;
use App\MoonShine\Pages\Post\PostDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Date;

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
            PostIndexPage::class,  // Список новостей
            PostFormPage::class,   // Форма создания/редактирования
            PostDetailPage::class, // Детальная страница новости
        ];
    }

    /**
     * Поля, отображаемые на странице списка новостей
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make(__('moonshine::ui.resource.name'), 'title'),
        ];
    }

    /**
     * Поля, отображаемые в форме создания/редактирования
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->sortable(),
                Text::make('Название новости', 'title')->required(),
                Textarea::make('Тело новости', 'body')
                    ->customAttributes(['rows' => 10])
                    ->required(),
                Select::make('Автор', 'user_id') // Используем Select для выбора автора
                    ->options(User::pluck('name', 'id')->toArray())
                    ->required(),
            ])
        ];
    }

    /**
     * Поля, отображаемые на детальной странице просмотра
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            Textarea::make('Текст новости', 'body')->readonly(),
            Text::make('Автор', 'user.name')->readonly(), // Отображение имени автора
            Date::make('Дата публикации', 'created_at')->readonly(),
        ];
    }

    /**
     * Правила валидации для формы создания/редактирования
     *
     * @param Post $item
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'], // Проверка существования автора
        ];
    }
}

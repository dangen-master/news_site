# Команды для запуска
После слияния ветки в первую очередь нужно обновить зависимости с помощью команды
- composer update
 

После чего запускаем следующую команду для включения русской локализации
- php artisan lang:update


Установить админку
- php artisan moonshine:install

Включить русский язык в админке
- php artisan vendor:publish --provider="MoonShine\Ru\Providers\RuServiceProvider"

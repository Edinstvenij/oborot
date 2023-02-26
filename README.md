<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Как развернуть проект?

1. Скачиваем проект <code>gh repo clone Edinstvenij/oborot yourDirectory</code>
2. Запустите <code>composer install</code>
3. Запускаем локальный сервер (Нужна БД)
4. Раз комментируйте файл .env и в нем пишем свой логин и пароль к базе данных (DB_)
5. Генерируем ключ <code>php artisan key:generate</code>
6. Пишем в консоли: <code>php artisan migrate --seed</code> флаг --seed заполнит БД тестовыми данными, то что нам и
   нужно для теста
7. Пишем: <code>php artisan serve</code> Запустим так потому что нам нужно что бы сервер смотрел в директорию
   /public
8. Готово) URL выведется в консоль
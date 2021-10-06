1. Развертывание приложения
    Предполагается что папка с проектом уже скопирована с репозитория. А также создана база данных journal
    1) Делаем миграции таблиц: php artisan migrate

2. Использование компонента
    1) Вывод таблицы в консоли: php artisan plot:reestrNumber 69:27:0000022:1306 69:27:0000022:1307
    2) Вывод таблицы в браузере: открыть адрес "/", ввести кадастровые номера через запятую
    3) Вывод json по api адресу "http://server.name/api/test/plots"
    4) Написано 5 тестов.

![api реализация](https://github.com/ivasha89/rosreestr/tree/master/storage/app/public/api.jpg)
![console реализация](https://github.com/ivasha89/rosreestr/tree/master/storage/app/public/console.jpg)
![web реализация](https://github.com/ivasha89/rosreestr/tree/master/storage/app/public/web.jpg)

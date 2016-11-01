##Требования:
Должен быть установлен **docker** и **docker-compose** актуальных версий.

## Описание 
В поставку входит:
 - php 7.0.8
 - nginx
 - nodejs

## Старт сервера
1. ```make start-dev```
2. Публичная папка находится по пути `app/public`; 

## Доступ 
`http://localhost:10080`

## Разворачивание проекта
1. ```make start-dev```
2. `make shell-node` -> `gulp && exit`;
3. `make shell-dev` -> `composer install && exit`


## Первое задание
1. Код находится в папке `app/src`
2. Запуск тестов для первого задания ```make phpunit```
3. В публичной папке лежит тестовый файл parser.php


## Второе задание
1. Код находится в папке `app/resources/js`
2. Запуск кода `http://localhost:10080/index.html`
 





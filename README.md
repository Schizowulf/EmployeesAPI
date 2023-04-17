# Employees API

Для сервиса использован фреймворĸ Laravel. Этот микросервис позволяет получать и
управлять данными о сотрудниĸах по REST API.

Имеется поиск по базе данных (нечеткий: Levenshtein), сортировка и пагинация в ответе.

Весь проект упакован в Docker compose (Laravel 10, nginx, PostgreSQL). 

## Installation
```
cd .\employees-app\
docker compose up -d
docker exec -it project_app bash
```
Следующую команду выполнить в терминале контейнера:
```
php artisan migrate --seed
```

## Documentation

https://app.swaggerhub.com/apis/DmitryPeKo/open-api_employee_api/0.0.1

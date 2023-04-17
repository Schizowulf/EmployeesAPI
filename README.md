# Employees API

Весь проект упакован в Docker compose. 

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

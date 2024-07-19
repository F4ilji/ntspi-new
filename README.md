# NTSPI-NEW
### Клонируйте репозиторий с GitHub:

```bash
git clone https://github.com/F4ilji/ntspi-new.git
```

### Установка контейнеров с помощью Docker.

Перейдите в директорию проекта:
```bash
cd ntspi-new
```
Запустите контейнеры с помощью Docker Compose:
```bash
docker-compose up -d
```

### Установка зависимостей
Зайдите в контейнер ntspi-php:
```bash
docker exec -it ntspi-php bash
```
Установите зависимости Composer:
```bash
composer install
```
Установите зависимости NPM:
```bash
npm install
```
Создайте файл .env на основе .env.example:
```bash
cp .env.example .env
```
Настройте подключение к базе данных в файле .env:
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=ntspi_db
DB_USERNAME=admin
DB_PASSWORD=secret
```

### Миграция и заполнение базы данных
Выполните миграции и заполнение базы данных:
```php
php artisan migrate --seed
```
## License

[MIT](https://choosealicense.com/licenses/mit/)

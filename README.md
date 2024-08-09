# NTSPI-NEW
### Клонируйте репозиторий с GitHub:

```git
git clone https://github.com/F4ilji/ntspi-new.git
```

### Установка контейнеров с помощью Docker.

Перейдите в директорию проекта:
```bash
cd ntspi-new
```
Запустите контейнеры с помощью Docker Compose:
```docker
docker-compose up -d
```

### Установка зависимостей
Зайдите в контейнер ntspi-php:
```docker
docker exec -it ntspi-php bash
```
Установите зависимости Composer:
```composer
composer install
```
Установите зависимости NPM:
```npm
npm install
```
Сгенерируйте новый ключ приложения:
```php
php artisan key:generate
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

### Запуск js билдера
```npm
npm run dev
```
## License

[MIT](https://choosealicense.com/licenses/mit/)

# Blockledge

## Технологии

- PHP 8.5 + Symfony 8
- PostgreSQL
- Redis
- Docker / Docker Compose
- Symfony Messenger (для очередей)
- PSR-стандарты и DDD-подход

## Архитектура

Проект использует **Domain-Driven Design (DDD)** с чистой архитектурой:

- **Domain Layer**: Чистая бизнес-логика, независимая от фреймворков
- **Application Layer**: Use Cases и оркестрация
- **Infrastructure Layer**: Doctrine, адаптеры, очереди
- **UI Layer**: HTTP контроллеры и API

### Bounded Contexts

- **Ledger**: Система двойной записи
- **Web3**: Интеграция с блокчейном
- **Shared**: Общие компоненты

## Установка и запуск

### Требования

- Docker и Docker Compose
- Git

### Первый запуск

1. Клонируйте репозиторий:
```bash
git clone <repository-url>
cd Blockledge
```

2. Отредактируйте `.env` файл, если необходимо изменить порты или настройки БД

3. Запустите Docker контейнеры:
```bash
docker compose up -d --build
```

4. Установите зависимости (если не установились при сборке):
```bash
docker compose exec app composer install
```

5. Выполните миграции базы данных:
```bash
docker compose exec app bin/console doctrine:migrations:migrate
```

### Доступ к приложению

- Веб-приложение: http://localhost:8085
- PostgreSQL: localhost:5432
- Redis: localhost:6379

### Полезные команды

```bash
# Остановить контейнеры
docker compose down

# Просмотр логов
docker compose logs -f

# Выполнить команду внутри контейнера
docker compose exec app bin/console <command>

# Запустить тесты
docker compose exec app bin/phpunit
```


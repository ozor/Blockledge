# Базовый образ
FROM php:8.5-fpm

# Аргументы для пользователя (если нужно потом переключать пользователя)
ARG UID=1000
ARG GID=1000

# Гарантируем root для системных операций
USER root

# Установим системные зависимости и библиотеки, нужные для расширений
RUN mkdir -p /var/lib/apt/lists/partial \
    && apt-get update && apt-get install -y \
        git \
        curl \
        unzip \
        zip \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        zlib1g-dev \
        libxml2-dev \
        libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# Установка PHP-расширений
RUN docker-php-ext-install \
        intl \
        pdo_pgsql \
        pgsql \
        zip \
        bcmath

# Устанавливаем Redis PHP-extension через PECL
RUN if ! php -m | grep -qi '^redis$'; then \
        pecl install redis; \
    fi \
    && docker-php-ext-enable redis

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настройка рабочего каталога
WORKDIR /var/www/blockledge

# Копирование зависимостей composer сначала (для кеша сборки)
COPY composer.json composer.lock symfony.lock ./

# Установка зависимостей приложения БЕЗ выполнения скриптов (т.к. bin/console еще нет)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Копируем весь код в контейнер
COPY . .

# Теперь запускаем скрипты, когда все файлы на месте
RUN composer run-script post-install-cmd

# При желании можно поменять владельца на нелокального пользователя,
# чтобы запускать процессы не от root-а.
#RUN groupadd --gid $GID appgroup \
#    && useradd --uid $UID --gid appgroup --shell /bin/bash --create-home appuser \
#    && chown -R appuser:appgroup /var/www/blockledge

# Укажем пользователя приложения
USER appuser

# Expose порт для php-fpm
EXPOSE 9000

CMD ["php-fpm"]

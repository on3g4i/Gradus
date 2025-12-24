FROM php:8.2-cli

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# PHP deps
RUN composer install --no-dev --optimize-autoloader

# Frontend build
RUN npm install && npm run build

# 🔑 PERMISSÕES (ESSENCIAL)
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# 🔥 USAR PORT DINÂMICO
CMD php artisan serve --host=0.0.0.0 --port=${PORT}

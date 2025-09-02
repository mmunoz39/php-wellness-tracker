FROM php:8.2-fpm

# System deps for extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
# - pdo: built-in in PHP 8.2 (no need to install)
# - pdo_mysql: compiles without extra system deps
# - pdo_sqlite: needs libsqlite3-dev installed above
RUN docker-php-ext-install pdo_mysql pdo_sqlite

# (Optional) Useful tools
RUN apt-get update && apt-get install -y --no-install-recommends \
    curl vim less \
    && rm -rf /var/lib/apt/lists/*


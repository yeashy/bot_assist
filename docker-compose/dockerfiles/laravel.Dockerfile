FROM php:8.2-fpm as base

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# get install script and pass it to execute:
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash
# and install node
RUN apt-get install -y \
    nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/app

COPY ../scripts/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

ARG APP_ENV
ENV APP_ENV=${APP_ENV}
ENV USER=$user

FROM base AS local-target

CMD ["/usr/local/bin/start.sh"]

FROM base AS development-target

CMD ["/usr/local/bin/start.sh"]

COPY ../scripts/antimalware.sh /usr/local/bin/antimalware.sh

CMD ["/usr/local/bun/antimalware.sh"]

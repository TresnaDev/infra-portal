FROM dunglas/frankenphp:latest-php8.3-alpine

RUN install-php-extensions \
    pdo_pgsql \
    redis \
    pcntl \
    opcache \
    intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY --from=node:22-alpine /usr/local/bin/node /usr/local/bin/node
COPY --from=node:22-alpine /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -sf /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

WORKDIR /app

COPY . .
RUN rm -rf node_modules
RUN composer install --no-dev --optimize-autoloader
RUN npm ci

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

COPY docker/frankenphp/Caddyfile /etc/caddy/Caddyfile
COPY docker/frankenphp/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80 443

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
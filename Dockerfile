FROM code4romania/php:8.4 AS vendor

# Switch to root so we can do root things
USER root

# Install additional PHP extensions
RUN set -ex; \
    install-php-extensions \
    imagick

RUN set -ex; \
    apk add --no-cache \
    ffmpeg

# Drop back to our unprivileged user
USER www-data

COPY --chown=www-data:www-data . /var/www/html

RUN set -ex; \
    composer install \
    --optimize-autoloader \
    --no-interaction \
    --no-plugins \
    --no-dev \
    --prefer-dist

FROM node:24-alpine AS assets

WORKDIR /build

COPY \
    package.json \
    package-lock.json \
    postcss.config.js \
    vite.config.js \
    ./

RUN set -ex; \
    npm ci --no-audit --ignore-scripts

COPY --from=vendor /var/www/html /build

RUN set -ex; \
    npm run build

FROM vendor

ARG VERSION
ARG REVISION

RUN echo "$VERSION (${REVISION:0:7})" > /var/www/.version

COPY --from=assets --chown=www-data:www-data /build/public/build /var/www/html/public/build

ENV QUEUE_ENABLED=true

# The number of jobs to process before stopping
ENV QUEUE_MAX_JOBS 5

# Number of seconds to sleep when no job is available
ENV QUEUE_SLEEP 10

# Number of seconds to rest between jobs
ENV QUEUE_REST 1

# The number of seconds a child process can run
ENV QUEUE_TIMEOUT 600

# Number of times to attempt a job before logging it failed
ENV QUEUE_TRIES 1

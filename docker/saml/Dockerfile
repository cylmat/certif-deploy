FROM php:8.3-apache AS base
# image: richarvey/nginx-php-fpm

COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

RUN apt update && apt install -y curl git vim wget zip

# ### #
# Php #
# ### #

# Used for SimpleSaml
RUN apt install -y libldap2-dev libxml2-dev libzip-dev
RUN docker-php-ext-install ldap xml zip

# Memcached
# RUN apt-get update && apt-get install --no-install-recommends -y memcached libmemcached-tools libzip-dev zlibc zlib1g \
#   && docker-php-ext-configure zip --with-libzip \
#   && docker-php-ext-install zip \
#   && git clone https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached \
#   && cd /usr/src/php/ext/memcached && git checkout -b php8 origin/php8 \
#   && docker-php-ext-configure memcached \
#   && docker-php-ext-install memcached



# #### #
# SAML #
# #### #

WORKDIR /tmp
RUN wget https://github.com/simplesamlphp/simplesamlphp/releases/download/v2.4.0/simplesamlphp-2.4.0-full.tar.gz \
    -O /tmp/simplesamlphp-2.4.0-full.tar.gz
RUN tar xzf /tmp/simplesamlphp-2.4.0-full.tar.gz
RUN mv /tmp/simplesamlphp-2.4.0 /var/simplesamlphp


RUN mkdir /var/cache/simplesamlphp
RUN chown -R www-data:www-data /var/cache/simplesamlphp

RUN mkdir /var/log/saml
RUN chown -R www-data:www-data /var/log/saml

# TODO
RUN chmod 777 -R /var/log

WORKDIR /var/simplesamlphp


# ### #
# SSL #
# ### #


# Activate SSL
# Install /etc/ssl/certs/ssl-cert-snakeoil.pem
RUN apt install -y openssl ssl-cert
RUN a2enmod ssl
RUN a2ensite default-ssl
# RUN a2dissite default -> Disable "http" site, or use "Redirect permanent / https://server.domain.fr?"

RUN mv /etc/apache2/sites-enabled/000-default.conf /tmp/000-default.conf.backup


RUN a2query -s
RUN apachectl -M
RUN apachectl configtest
RUN apache2ctl -S

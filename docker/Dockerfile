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

WORKDIR /var/simplesamlphp



# ### #
# SSL #
# ### #

FROM base AS ssl

# Activate SSL
# Install /etc/ssl/certs/ssl-cert-snakeoil.pem
RUN apt install -y openssl ssl-cert
RUN a2enmod ssl
RUN a2ensite default-ssl
# RUN a2dissite default -> Disable "http" site, or use "Redirect permanent / https://server.domain.fr?"

RUN sed -i -e "s#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#" /etc/apache2/sites-enabled/000-default.conf
RUN sed -i -e "s#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#" /etc/apache2/sites-enabled/default-ssl.conf

RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -sha256 -out /etc/apache2/server.crt -keyout /etc/apache2/server.key \
    -subj "/C=fr/CN=www.generated.com"
RUN chmod 440 /etc/apache2/server.crt

# Update /etc/apache2/sites-available/default-ssl.conf
RUN sed -i -e "s#SSLCertificateFile .*#SSLCertificateFile /etc/apache2/server.crt#" /etc/apache2/sites-enabled/default-ssl.conf
RUN sed -i -e "s#SSLCertificateKeyFile .*#SSLCertificateKeyFile /etc/apache2/server.key#" /etc/apache2/sites-enabled/default-ssl.conf


FROM php:8.3-apache AS base

RUN apt update && apt install -y curl git vim wget zip

# https://www.it-connect.fr/configurer-le-ssl-avec-apache-2%EF%BB%BF/
RUN apt install -y openssl ssl-cert
RUN a2enmod ssl
RUN a2ensite default-ssl
# a2dissite default (desactivate http)
# service apache2 reload

RUN a2query -s
RUN apachectl -M
RUN apachectl configtest
RUN apache2ctl -S

# must force site directory in apache config
WORKDIR /tmp

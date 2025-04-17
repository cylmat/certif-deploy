# SSL (Secure Socket Layer) et le TLS (Transport Layer Security)


In apache container
```
apt install ssl-cert
a2enmod ssl
a2ensite default-ssl
service apache2 reload
```

In case we want our own cerificat
```
apt-get install openssl
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -sha256 -out /etc/apache2/server.crt -keyout /etc/apache2/server.key \
    -subj "/C=de/CN=www.example.com"
chmod 440 /etc/apache2/server.crt

# update /etc/apache2/sites-available/default-ssl.conf
SSLCertificateFile      /etc/apache2/server.crt
SSLCertificateKeyFile   /etc/apache2/server.key
```


**Ref**
---
- https://letsencrypt.org
- https://doc.ubuntu-fr.org/tutoriel/securiser_apache2_avec_ssl

Tuto:
- https://knplabs.com/fr/blog/comment-mettre-en-place-le-https
- https://www.digicert.com/kb/csr-ssl-installation/nginx-openssl.htm  
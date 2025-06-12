# SSL (Secure Socket Layer) et le TLS (Transport Layer Security)

```
    Entrypoints  |           Traefik            |  Service docker
       80  \     |                       /http  | VirtualHost *:80
            -----| certs       service --       | 
       443 /     |                       \https | VirtualHost *:443
```

In apache container
```
apt install -y openssl ssl-cert
a2enmod ssl
a2ensite default-ssl
service apache2 reload
```

In case we want our own cerificat
```
openssl req -x509 -out localhost.crt -keyout localhost.key -newkey rsa:2048 -nodes -sha256 \
-subj '/CN=localhost' -extensions EXT -config <( \
printf "[dn]\nCN=localhost\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:localhost\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth")

# update /etc/apache2/sites-available/default-ssl.conf
SSLCertificateFile      /etc/apache2/server.crt
SSLCertificateKeyFile   /etc/apache2/server.key
```

-- or

```
sudo apt install mkcert
mkcert -install

mkcert -cert-file certs/local-cert.pem -key-file certs/local-key.pem "docker.localhost" "*.docker.localhost" "domain.local" "*.domain.local"
```

**Careful**
- Certificat MUST match server name: https://my.server.name => openssl...CN=my.server.name... (no typo)
- Open port (443)
- (add Cache-Control:no-store... in index.php to test changes)
- use "apache2ctl -S" to test config
- use good file in docker compose -f <compose>.yml

!!!
TRAEFIK redirect HTTPS to http directory
    http  -> vhost.conf:80 DocumentRoot /var/specific/http
    https -> vhost.conf:80 DocumentRoot /var/specific/http


## Error
```
treafik error tls: failed to verify certificate: x509
cannot validate certificate for 172.18.0.3 because it doesn't contain any IP SANs
> traefik try to reach internal server 172.18.0.3 with a certficate of tls.sample.one.local

soluce (for internal or dev)
=> - "traefik.http.services.secure-service.loadbalancer.server.insecureSkipVerify=true"
```


## Ref
---
- https://letsencrypt.org
- https://doc.ubuntu-fr.org/tutoriel/securiser_apache2_avec_ssl

Def:
- Subject Alternative Name (SAN)

Tuto:
- https://letsencrypt.org/docs/certificates-for-localhost  
- https://knplabs.com/fr/blog/comment-mettre-en-place-le-https
- https://www.digicert.com/kb/csr-ssl-installation/nginx-openssl.htm

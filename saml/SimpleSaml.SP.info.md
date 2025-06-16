# Simple Saml run

Tuto:

- https://simplesamlphp.org/docs/stable/simplesamlphp-sp.html
    + https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api.html

## Run

Visit page with "https" only":
- https://localhost/simplesaml
- https://localhost/simplesaml/admin   (admin:admin1)



## Other

### Config

! USE SSL with https only !

- secretsalt => openssl rand -base64 32
- timezone => https://www.php.net/manual/en/timezones.php

[SP]
+ config/authsources.php

- Create certificat:
openssl req -newkey rsa:3072 -new -x509 -days 3652 -nodes -out saml.crt -keyout saml.pem

- Adding IdPs to the SP 
(use saml/custom/metadata/saml20-idp-remote.php)

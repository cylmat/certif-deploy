# Simple Saml run

Tuto:

- https://simplesamlphp.org/docs/stable/simplesamlphp-sp.html
- https://simplesamlphp.org/docs/stable/simplesamlphp-idp.html

## Run

Visit page with "https" only":
- https://localhost/simplesaml
- https://localhost/simplesaml/admin   (admin:admin1)

[IDP]
Go to test, then used-userpass:
https://localhost/simplesaml/module.php/admin/test   (user:pass)


## Other

### Config

in config/config.php

! USE SSL with https only !

- secretsalt => openssl rand -base64 32
- timezone => https://www.php.net/manual/en/timezones.php

### Ref

- https://simplesamlphp.org/docs/stable/simplesamlphp-install.html
- https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-simplesamlphp-for-saml-authentication-on-ubuntu-18-04-fr
- https://buckbeak99.medium.com/a-step-by-step-guide-to-configuring-simplesamlphp-bcd2dbd2b2b4
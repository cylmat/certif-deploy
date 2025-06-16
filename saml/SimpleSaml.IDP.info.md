# Simple Saml run

Tuto:

- https://simplesamlphp.org/docs/stable/simplesamlphp-idp.html

## Run

Visit page with "https" only":
- https://localhost/simplesaml
- https://localhost/simplesaml/admin   (admin:admin1)

[IDP]
Go to test, then sp-userpass:
https://localhost/simplesaml/module.php/admin/test   (user:pass)


## Other

### Config

! USE SSL with https only !

- secretsalt => openssl rand -base64 32
- timezone => https://www.php.net/manual/en/timezones.php

[IDP]
+ in config/config.php
'enable.saml20-idp' => true

'module.enable' => [
    'exampleauth' => true,
    …
],


- Create certificat:
openssl req -newkey rsa:3072 -new -x509 -days 3652 -nodes -out saml.crt -keyout saml.pem













### Definition

SAML:
- 1. User connect to IP (Identity provider)
- 2. User then connect to application's services SP (Service Provider1, Service Provider2...)
- 3. Connected SP send Request to IP
- 4. IP send response back to SP with allowed authorization or not.

Def:
- ACS: Assertion Consumer Service (ACS) is a web service endpoint that is used in the SAML authentication and authorization protocol. The ACS is a service provided by the service provider (SP) that receives and processes SAML assertions from the identity provider (IdP)
- Identify Provider: Source of truth of database user's authentication
- Service Provider: Must be in sync with users identity sources.
- Provisionning: Keep service provider updated of users accounts.

### Ref

- https://simplesamlphp.org/docs/stable/simplesamlphp-install.html
- https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-simplesamlphp-for-saml-authentication-on-ubuntu-18-04-fr
- https://buckbeak99.medium.com/a-step-by-step-guide-to-configuring-simplesamlphp-bcd2dbd2b2b4
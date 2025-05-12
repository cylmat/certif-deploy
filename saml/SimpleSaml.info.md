# Simple Saml run

Tuto:
- https://simplesamlphp.org/docs/stable/simplesamlphp-install.html
- https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-simplesamlphp-for-saml-authentication-on-ubuntu-18-04-fr
- https://buckbeak99.medium.com/a-step-by-step-guide-to-configuring-simplesamlphp-bcd2dbd2b2b4

## Run

Visit page:
- http://localhost/simplesaml
- http://localhost/simplesaml/admin


### Config

! USE SSL !

- secretsalt => openssl rand -base64 32
- timezone => https://www.php.net/manual/en/timezones.php

config/config.php
```
'baseurlpath' => 'simplesaml/',
'auth.adminpassword'  => 'admin1',
'secretsalt' => 'your_generated_salt',
'technicalcontact_name' => 'Administrator',
'technicalcontact_email' => 'na123sample@example.org',
'timezone' => 'Europe/Amsterdam'

'session.cookie.secure' => true,

# see 'module.enable' 
```

<?php

/**
 * SAML 2.0 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote
 * 
 */

$metadata['https://saml.idp.local'] = [
    'SingleSignOnService' => [
        [
          'Location' => 'https://saml.idp.local/simplesaml/saml2/idp/SSOService.php',
          'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ],
    ],
    'SingleLogoutService' => [
        [
          'Location' => 'https://saml.idp.local/simplesaml/saml2/idp/SingleLogoutService.php',
          'ResponseLocation' => 'https://saml.idp.local/LogoutResponse',
          'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
        ],
    ],
    'certificate' => 'saml.idp.local.crt',
];
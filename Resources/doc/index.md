IfdatticCipherBundle
====================

The IfdatticCipherBundle adds a service for encrypting/decrypting values in Symfony2.

Installation
------------

Add the requirement to composer:

```bash
$ php composer.phar require ifdattic/cipher-bundle '~1.0@dev'
```

Enable the bundle in your kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Ifdattic\CipherBundle\IfdatticCipherBundle(),
    );
}
```

Configuration
-------------

Change the `iv` and `key` being used in cipher to encrypt/decrypt values. Update `app/config/parameters.yml.dist` with following changes:

```yml
parameters:
    # ...
    ifdattic_cipher.external_cipher.iv: ~
    ifdattic_cipher.external_cipher.key: ~
```

And make those values unique to your project in `app/config/parameters.yml` file (just make sure not to commit them to source code as it could lead to security holes).

Usage
-----

The service has helper methods which return `EncryptedToken` model for encrypting/decrypting value.

```php
// in controller
$cipher = $this->container->get('ifdattic_cipher');

$encryptedTokenFromPlain = $cipher->getEncryptedTokenFromPlainValue('plain value');
$plainValue = $encryptedTokenFromPlain->getPlain(); // will be: plain value
$encryptedValue = $encryptedTokenFromPlain->getEncrypted(); // can be: cT0DdcTVPOm8LPTbg0WQuw==

$encryptedTokenFromEncrypted = $cipher->getEncryptedTokenFromEncryptedValue('cT0DdcTVPOm8LPTbg0WQuw==');
$encryptedValue = $encryptedTokenFromEncrypted->getEncrypted(); // will be: cT0DdcTVPOm8LPTbg0WQuw==
$plainValue = $encryptedTokenFromEncrypted->getPlain(); // can be: plain value

// or if you want to use it right away (like before saving to database)
$model->setToken($cipher->getEncryptedTokenFromPlainValue('plain value')->getEncrypted());
```

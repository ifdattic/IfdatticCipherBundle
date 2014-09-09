<?php

/**
 * This file is part of the IfdatticCipherBundle package.
 *
 * (c) IFDattic <http://ifdattic.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ifdattic\CipherBundle\Security;

use Ifdattic\CipherBundle\Model\EncryptedToken;

/**
 * @author Andrew (Andrius) Marcinkevicius <andrew.web@ifdattic.com>
 */
class Cipher implements CipherInterface, HasEncryptedTokenInterface
{
    /**
     * The cipher object for encrypting/decrypting values
     * @var object|null
     */
    protected $cipher;

    /**
     * Constructor
     * @param object|array|null $cipher
     */
    public function __construct($cipher = null)
    {
        if (is_null($cipher)) {
            $cipher = ['class' => 'Crypt_AES', 'mode' => 'CRYPT_AES_MODE_CBC'];
        }

        if (is_array($cipher)) {
            $cipher = new $cipher['class']($cipher['mode']);
        }

        $this->cipher = $cipher;
    }

    /**
     * {@inheritDoc}
     */
    public function getCipher()
    {
        return $this->cipher;
    }

    /**
     * {@inheritDoc}
     */
    public function getEncryptedTokenFromPlainValue($value)
    {
        return new EncryptedToken($value, $this->cipher, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getEncryptedTokenFromEncryptedValue($value)
    {
        return new EncryptedToken($value, $this->cipher, false);
    }
}

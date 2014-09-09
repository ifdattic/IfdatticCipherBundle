<?php

/**
 * This file is part of the IfdatticCipherBundle package.
 *
 * (c) IFDattic <http://ifdattic.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ifdattic\CipherBundle\Model;

/**
 * Model to allow managing between encrypted/decrypted value.
 *
 * @author Andrew (Andrius) Marcinkevicius <andrew.web@ifdattic.com>
 */
class EncryptedToken implements EncryptedTokenInterface
{
    /**
     * The cipher used for encryption/decryption
     * @var object
     */
    protected $cipher;

    /**
     * The encrypted token value
     * @var string|null
     */
    protected $encryptedToken;

    /**
     * The plain (decrypted) token value
     * @var string|null
     */
    protected $plainToken;

    /**
     * {@inheritDoc}
     */
    public function __construct($token, $cipher, $isPlain = true)
    {
        if ($isPlain) {
            $this->plainToken = $token;
        } else {
            $this->encryptedToken = $token;
        }

        $this->cipher = $cipher;
    }

    /**
     * Encrypt plain token
     * @return self
     */
    protected function encrypt()
    {
        $this->encryptedToken = base64_encode($this->cipher->encrypt($this->plainToken));

        return $this;
    }

    /**
     * Decrypt encrypted token
     * @return self
     */
    protected function decrypt()
    {
        $this->plainToken = $this->cipher->decrypt(base64_decode($this->encryptedToken));

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEncrypted()
    {
        if (is_null($this->encryptedToken)) {
            $this->encrypt();
        }

        return $this->encryptedToken;
    }

    /**
     * {@inheritDoc}
     */
    public function getPlain()
    {
        if (is_null($this->plainToken)) {
            $this->decrypt();
        }

        return $this->plainToken;
    }
}

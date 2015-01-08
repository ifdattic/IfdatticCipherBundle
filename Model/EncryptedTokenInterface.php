<?php

/**
 * This file is part of the IfdatticCipherBundle package.
 *
 * (c) ifdattic <http://ifdattic.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ifdattic\CipherBundle\Model;

/**
 * @author Andrew (Andrius) Marcinkevicius <andrew.web@ifdattic.com>
 */
interface EncryptedTokenInterface
{
    /**
     * Create a new token model
     * @param string  $token
     * @param object  $cipher   The cipher used for encryption/decryption
     * @param boolean $isPlain  Take the safe approach and always treat values like they should be encrypted
     */
    public function __construct($token, $cipher, $isPlain = true);

    /**
     * Get encrypted token value
     * @return string
     */
    public function getEncrypted();

    /**
     * Get plain token value
     * @return string
     */
    public function getPlain();
}

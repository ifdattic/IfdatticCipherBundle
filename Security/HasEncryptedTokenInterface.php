<?php

/**
 * This file is part of the IfdatticCipherBundle package.
 *
 * (c) ifdattic <http://ifdattic.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ifdattic\CipherBundle\Security;

/**
 * @author Andrew (Andrius) Marcinkevicius <andrew.web@ifdattic.com>
 */
interface HasEncryptedTokenInterface
{
    /**
     * Get the encrypted token model from plain value
     * @param  string $value plain value to initialize model with
     * @return \Ifdattic\CipherBundle\Model\EncryptedTokenInterface
     */
    public function getEncryptedTokenFromPlainValue($value);

    /**
     * Get the encrypted token model from encrypted value
     * @param  string $value encrypted value to initialize model with
     * @return \Ifdattic\CipherBundle\Model\EncryptedTokenInterface
     */
    public function getEncryptedTokenFromEncryptedValue($value);
}

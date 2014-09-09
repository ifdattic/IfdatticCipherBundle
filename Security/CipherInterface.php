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

/**
 * @author Andrew (Andrius) Marcinkevicius <andrew.web@ifdattic.com>
 */
interface CipherInterface
{
    /**
     * Get cipher object for encrypting/decrypting values
     * @return object|null
     */
    public function getCipher();
}

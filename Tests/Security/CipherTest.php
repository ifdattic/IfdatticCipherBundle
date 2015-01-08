<?php

/**
 * This file is part of the IfdatticCipherBundle package.
 *
 * (c) ifdattic <http://ifdattic.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ifdattic\CipherBundle\Tests\Security;

use Ifdattic\CipherBundle\Security\Cipher;

/**
 * @author Andrew (Andrius) Marcinkevicius <andrew.web@ifdattic.com>
 */
class CipherTest extends \PHPUnit_Framework_TestCase
{
    protected $externalCipher;

    public function setUp()
    {
        $this->externalCipher = $this->getMock('Crypt_AES', [], ['CRYPT_AES_MODE_CBC']);
    }

    /**
     * @test
     * @group unit
     */
    public function objectIsConstructedUsingCipherObject()
    {
        $cipher = new Cipher($this->externalCipher);

        $this->assertEquals($this->externalCipher, $cipher->getCipher());
    }

    /**
     * @test
     * @group unit
     */
    public function objectIsConstructedUsingArrayForCipherObject()
    {
        $externalCipher = ['class' => 'Crypt_AES', 'mode' => 'CRYPT_AES_MODE_CBC'];
        $cipher = new Cipher($externalCipher);

        $this->assertInstanceOf('Crypt_AES', $cipher->getCipher());
    }

    /**
     * @test
     * @group unit
     */
    public function objectIsConstructerWhenUsingNullForCipherObject()
    {
        $cipher = new Cipher(null);

        $this->assertInstanceOf('Crypt_AES', $cipher->getCipher());
    }

    /**
     * @test
     * @group unit
     */
    public function encryptedTokenWithPlainValueIsReturnedUsingHelperMethod()
    {
        $cipher = new Cipher($this->externalCipher);
        $plainValue = 'plainValue';
        $instanceName = '\\Ifdattic\\CipherBundle\\Model\\EncryptedTokenInterface';

        $encryptedToken = $cipher->getEncryptedTokenFromPlainValue($plainValue);

        $this->assertInstanceOf($instanceName, $encryptedToken);
        $this->assertSame($plainValue, $encryptedToken->getPlain());
    }

    /**
     * @test
     * @group unit
     */
    public function encryptedTokenWithEncryptedValueIsReturnedUsingHelperMethod()
    {
        $cipher = new Cipher($this->externalCipher);
        $encryptedValue = 'ZW5jcnlwdGVkVmFsdWU=';
        $instanceName = '\\Ifdattic\\CipherBundle\\Model\\EncryptedTokenInterface';

        $encryptedToken = $cipher->getEncryptedTokenFromEncryptedValue($encryptedValue);

        $this->assertInstanceOf($instanceName, $encryptedToken);
        $this->assertSame($encryptedValue, $encryptedToken->getEncrypted());
    }
}

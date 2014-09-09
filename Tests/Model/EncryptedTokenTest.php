<?php

/**
 * This file is part of the IfdatticCipherBundle package.
 *
 * (c) IFDattic <http://ifdattic.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ifdattic\CipherBundle\Tests\Model;

use Ifdattic\CipherBundle\Model\EncryptedToken;

/**
 * @author Andrew (Andrius) Marcinkevicius <andrew.web@ifdattic.com>
 */
class EncryptedTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @group unit
     */
    public function plainValueIsReturnedWhenCreatingWithPlainValue()
    {
        $cipher = $this->getMock('Crypt_AES', [], ['CRYPT_AES_MODE_CBC']);
        $expectedPlainValue = 'plainValue';
        $encryptedToken = new EncryptedToken($expectedPlainValue, $cipher);

        $plainValue = $encryptedToken->getPlain();

        $this->assertSame($expectedPlainValue, $plainValue);
    }

    /**
     * @test
     * @group unit
     */
    public function plainValueIsReturnedWhenCreatingWithEncryptedValue()
    {
        $expectedPlainValue = 'plainValue';
        $encryptedValue = 'ZW5jcnlwdGVkVmFsdWU=';
        $cipher = $this->getMock('Crypt_AES', [], ['CRYPT_AES_MODE_CBC']);
        $cipher->expects($this->once())
            ->method('decrypt')
            ->with($this->equalTo('encryptedValue'))
            ->will($this->returnValue($expectedPlainValue))
        ;
        $encryptedToken = new EncryptedToken($encryptedValue, $cipher, false);

        $plainValue = $encryptedToken->getPlain();

        $this->assertSame($expectedPlainValue, $plainValue);
    }

    /**
     * @test
     * @group unit
     */
    public function encryptedValueIsReturnedWhenCreatingWithEncryptedValue()
    {
        $cipher = $this->getMock('Crypt_AES', [], ['CRYPT_AES_MODE_CBC']);
        $expectedEncryptedValue = 'ZW5jcnlwdGVkVmFsdWU=';
        $encryptedToken = new EncryptedToken($expectedEncryptedValue, $cipher, false);

        $encryptedValue = $encryptedToken->getEncrypted();

        $this->assertSame($expectedEncryptedValue, $encryptedValue);
    }

    /**
     * @test
     * @group unit
     */
    public function encryptedValueIsReturnedWhenCreatingWithPlainValue()
    {
        $expectedEncryptedValue = 'ZW5jcnlwdGVkVmFsdWU=';
        $plainValue = 'plainValue';
        $cipher = $this->getMock('Crypt_AES', [], ['CRYPT_AES_MODE_CBC']);
        $cipher->expects($this->once())
            ->method('encrypt')
            ->with($this->equalTo($plainValue))
            ->will($this->returnValue('encryptedValue'))
        ;
        $encryptedToken = new EncryptedToken($plainValue, $cipher);

        $encryptedValue = $encryptedToken->getEncrypted();

        $this->assertSame($expectedEncryptedValue, $encryptedValue);
    }
}

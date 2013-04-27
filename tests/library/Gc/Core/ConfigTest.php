<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Library
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Gc\Core;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Config
     *
     * @return void
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Config;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * Test
     *
     * @covers Gc\Core\Config::getInstance
     *
     * @return void
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf('Gc\Core\Config', Config::getInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Core\Config::getValue
     *
     * @return void
     */
    public function testGetValue()
    {
        $this->object->insert(array('identifier' => 'string_test', 'value' => 'string_result'));
        $this->assertEquals('string_result', $this->object->getValue('string_test'));
        $this->object->delete(array('identifier' => 'string_test'));
    }

    /**
     * Test
     *
     * @covers Gc\Core\Config::getValue
     *
     * @return void
     */
    public function testGetValueWithEmptyIdentifier()
    {
        $this->assertNull($this->object->getValue(''));
    }

    /**
     * Test
     *
     * @covers Gc\Core\Config::getValues
     *
     * @return void
     */
    public function testGetValues()
    {
        $this->assertInternalType('array', $this->object->getValues());
    }
    /**
     * Test
     *
     * @covers Gc\Core\Config::getValues
     *
     * @return void
     */
    public function testGetEmptyValues()
    {
        $values = $this->object->getValues();
        $this->object->delete('1 = 1');
        $this->assertInternalType('array', $this->object->getValues());

        //restore data
        foreach ($values as $value) {
            $this->object->insert($value);
        }
    }

    /**
     * Test
     *
     * @covers Gc\Core\Config::setValue
     *
     * @return void
     */
    public function testSetValueWithFakeIdentifier()
    {
        $this->assertFalse($this->object->setValue('fake_identifier', 'fake_value'));
    }

    /**
     * Test
     *
     * @covers Gc\Core\Config::setValue
     *
     * @return void
     */
    public function testSetValue()
    {
        $this->object->insert(array('identifier' => 'string_identifier', 'value' => 'string_result_insert_value'));
        $this->assertTrue((bool) $this->object->setValue('string_identifier', 'string_result_insert_new_value'));
        $this->object->delete(array('identifier' => 'string_identifier'));
    }

    /**
     * Test
     *
     * @covers Gc\Core\Config::setValue
     *
     * @return void
     */
    public function testSetValueWithEmptyIdentifier()
    {
        $this->assertFalse($this->object->setValue('', 'string_result_insert_value'));
    }
}

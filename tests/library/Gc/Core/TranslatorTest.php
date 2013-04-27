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
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Translator
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
        $this->object = new Translator;
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
     * @covers Gc\Core\Translator::getInstance
     *
     * @return void
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf('Gc\Core\Translator', Translator::getInstance());
    }

    /**
     * Test
     *
     * @covers Gc\Core\Translator::getValue
     *
     * @return void
     */
    public function testGetValue()
    {
        $this->object->setValue(
            'key',
            array(
                array(
                    'locale' => 'fr_FR',
                    'value' => 'clé',
                )
            )
        );
        $this->assertInternalType('array', $this->object->getValue('key', 'fr_FR'));
    }

    /**
     * Test
     *
     * @covers Gc\Core\Translator::getValues
     *
     * @return void
     */
    public function testGetValues()
    {
        $data = $this->object->getValues('fr_FR');
        $this->assertArrayHasKey(0, $data);
    }

    /**
     * Test
     *
     * @covers Gc\Core\Translator::getValues
     *
     * @return void
     */
    public function testGetValuesWithLimit()
    {
        $data = $this->object->getValues('fr_FR', 1);
        $this->assertArrayHasKey(0, $data);
    }

    /**
     * Test
     *
     * @covers Gc\Core\Translator::setValue
     *
     * @return void
     */
    public function testSetValue()
    {
        $result = $this->object->setValue(
            'parameters',
            array(
                array(
                    'locale' => 'fr_FR',
                    'value' => 'paramètres',
                ), array(
                    'locale' => '', //Missing locale
                    'value' => 'parametri',
                )
            )
        );
        $this->assertTrue($result);
    }

    /**
     * Test
     *
     * @covers Gc\Core\Translator::setValue
     *
     * @return void
     */
    public function testSetValueWithDestinationId()
    {
        $this->object->setValue(
            'parameters',
            array(
                array(
                    'locale' => 'fr_FR',
                    'value' => 'paramètres',
                )
            )
        );
        $data   = $this->object->getValue('parameters', 'fr_FR');
        $result = $this->object->setValue(
            'parameters',
            array(
                array(
                    'dst_id' => $data['dst_id'],
                    'locale' => 'it_IT',
                    'value' => 'parametri',
                )
            )
        );

        $this->assertTrue($result);
    }

    /**
     * Test
     *
     * @covers Gc\Core\Translator::setValue
     *
     * @return void
     */
    public function testSetValueWithSourceId()
    {
        $this->object->setValue(
            'parameters',
            array(
                array(
                    'locale' => 'fr_FR',
                    'value' => 'paramètres',
                )
            )
        );
        $data   = $this->object->getValue('parameters', 'fr_FR');
        $result = $this->object->setValue(
            $data['src_id'],
            array(
                array(
                    'locale' => 'it_IT',
                    'value' => 'parametri',
                )
            )
        );

        $this->assertTrue($result);
    }

    /**
     * Test
     *
     * @covers Gc\Core\Translator::setValue
     *
     * @return void
     */
    public function testSetValueWithUndefinedSourceId()
    {
        $this->assertFalse($this->object->setValue(40000000, array()));
    }
}

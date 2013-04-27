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

namespace Gc\View\Helper;

use Zend\Form\Element;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:08.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class FormCheckboxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FormCheckbox
     *
     * @return void
     */
    protected $object;
    /**
     * @var Element\Checkbox
     *
     * @return void
     */
    protected $element;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->element = new Element\Checkbox('foo');
        $options       = array(
            'checked_value' => 'checked',
            'unchecked_value' => 'unchecked',
        );

        $this->element->setOptions($options);
        $this->object = new FormCheckbox;
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
        unset($this->element);
    }

    /**
     * Test
     *
     * @covers Gc\View\Helper\FormCheckbox::render
     *
     * @return void
     */
    public function testRender()
    {
        $markup = $this->object->render($this->element);

        $this->assertContains('type="checkbox"', $markup);
        $this->assertContains('name="foo"', $markup);
    }

    /**
     * Test
     *
     * @covers Gc\View\Helper\FormCheckbox::render
     *
     * @return void
     */
    public function testRenderWithoutElementCheckbox()
    {
        $this->setExpectedException('Zend\Form\Exception\InvalidArgumentException');
        $this->object->render(new Element\Text('bar'));
    }

    /**
     * Test
     *
     * @covers Gc\View\Helper\FormCheckbox::render
     *
     * @return void
     */
    public function testRenderWithoutName()
    {
        $this->setExpectedException('Zend\Form\Exception\DomainException');
        $this->object->render(new Element\Checkbox());
    }

    /**
     * Test
     *
     * @covers Gc\View\Helper\FormCheckbox::render
     *
     * @return void
     */
    public function testRenderWithCheckedValue()
    {
        $this->element->setValue('checked');
        $markup = $this->object->render($this->element);
        $this->assertContains('checked="checked"', $markup);
    }

    /**
     * Test
     *
     * @covers Gc\View\Helper\FormCheckbox::render
     *
     * @return void
     */
    public function testRenderWithClassAndId()
    {
        $this->element->setValue('checked');
        $this->element->setAttribute('id', 'bar');
        $this->element->setAttribute('class', 'input-checkbox');
        $markup = $this->object->render($this->element);
        $this->assertContains('checked="checked"', $markup);
        $this->assertContains('class="input-checkbox"', $markup);
    }

    /**
     * Test
     *
     * @covers Gc\View\Helper\FormCheckbox::render
     *
     * @return void
     */
    public function testRenderWithClass()
    {
        $this->element->setValue('checked');
        $this->element->setAttribute('class', 'input-checkbox');
        $markup = $this->object->render($this->element);
        $this->assertContains('checked="checked"', $markup);
        $this->assertContains('class="input-checkbox"', $markup);
    }
}

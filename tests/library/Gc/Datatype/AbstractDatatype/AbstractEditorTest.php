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

namespace Gc\Datatype\AbstractDatatype;

use Gc\Datatype\Model as DatatypeModel,
    Gc\DocumentType\Model as DocumentTypeModel,
    Gc\Property\Model as PropertyModel,
    Gc\User\Model as UserModel,
    Gc\Tab\Model as TabModel,
    Gc\View\Model as ViewModel;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class AbstractEditorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractEditor
     */
    protected $_object;

    /**
     * @var TabModel
     */
    protected $_tab;

    /**
     * @var UserModel
     */
    protected $_user;

    /**
     * @var DocumentTypeModel
     */
     protected $_documentType;

    /**
     * @var PropertyModel
     */
    protected $_property;

    /**
     * @var ViewModel
     */
    protected $_view;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::__construct
     */
    protected function setUp()
    {
        $this->_datatype = DatatypeModel::fromArray(array(
            'name' => 'AbstractEditorTest',
            'prevalue_value' => 's:18:"AbstractEditorTest";',
            'model' => 'AbstractEditorTest',
        ));
        $this->_datatype->save();

        $this->_view = ViewModel::fromArray(array(
            'name' => 'View Name',
            'identifier' => 'View identifier',
            'description' => 'View Description',
            'content' => 'View Content'
        ));
        $this->_view->save();

        $this->_user = UserModel::fromArray(array(
            'lastname' => 'User test',
            'firstname' => 'User test',
            'email' => 'test@test.com',
            'login' => 'test',
            'user_acl_role_id' => 1,
        ));
        $this->_user->setPassword('test');
        $this->_user->save();

        $this->_documentType = DocumentTypeModel::fromArray(array(
            'name' => 'Document Type Name',
            'description' => 'Document Type description',
            'icon_id' => 1,
            'default_view_id' => $this->_view->getId(),
            'user_id' => $this->_user->getId(),
        ));
        $this->_documentType->save();

        $this->_tab = TabModel::fromArray(array(
            'name' => 'TabTest',
            'description' => 'TabTest',
            'sort_order' => 1,
            'document_type_id' => $this->_documentType->getId(),
        ));
        $this->_tab->save();

        $this->_property = PropertyModel::fromArray(array(
            'name' => 'DatatypeTest',
            'identifier' => 'DatatypeTest',
            'description' => 'DatatypeTest',
            'required' => FALSE,
            'sort_order' => 1,
            'tab_id' => $this->_tab->getId(),
            'datatype_id' => $this->_datatype->getId(),
        ));

        $this->_property->save();


        $mock_datatype = $this->getMockForAbstractClass('Gc\Datatype\AbstractDatatype');
        $mock_datatype->setProperty($this->_property);
        $mock_datatype->load($this->_datatype, 1);

        $this->_object = $this->getMockForAbstractClass('Gc\Datatype\AbstractDatatype\AbstractEditor', array($mock_datatype));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->_property->delete();
        $this->_datatype->delete();
        $this->_tab->delete();
        $this->_documentType->delete();
        $this->_user->delete();
        $this->_view->delete();
        unset($this->_datatype);
        unset($this->_property);
        unset($this->_documentType);
        unset($this->_tab);
        unset($this->_user);
        unset($this->_view);
        unset($this->_object);
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getValue
     */
    public function testGetValue()
    {
        $this->_object->setValue('test');
        $this->assertEquals('test', $this->_object->getValue());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::setValue
     */
    public function testSetValue()
    {
        $this->_object->setValue('test');
        $this->assertEquals('test', $this->_object->getValue());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getConfig
     */
    public function testGetConfig()
    {
        $this->assertEquals('AbstractEditorTest', $this->_object->getConfig());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::setConfig
     */
    public function testSetConfig()
    {
        $this->_object->setConfig('s:19:"AbstractEditorTest2";');
        $this->assertEquals('AbstractEditorTest2', $this->_object->getConfig());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getUploadUrl
     */
    public function testGetUploadUrl()
    {
        $this->assertEquals('/admin/content/media/upload/document/1/property/' . $this->_property->getId(), $this->_object->getUploadUrl());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getName
     */
    public function testGetName()
    {
        $this->assertEquals('datatype' . $this->_property->getId(), $this->_object->getName());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getProperty
     */
    public function testGetProperty()
    {
        $this->assertInstanceOf('Gc\Property\Model', $this->_object->getProperty());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getDatatype
     */
    public function testGetDatatype()
    {
        $this->assertInstanceOf('Gc\Datatype\AbstractDatatype', $this->_object->getDatatype());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getRequest
     */
    public function testGetRequest()
    {
        $this->assertInstanceOf('Zend\Http\PhpEnvironment\Request', $this->_object->getRequest());
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::render
     */
    public function testRender()
    {
        $this->_object->addPath(__DIR__ . '/../');
        $this->assertEquals('String' . PHP_EOL, $this->_object->render('_files/template.phtml'));
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::addPath
     */
    public function testAddPath()
    {
        $this->assertInstanceOf(get_class($this->_object), $this->_object->addPath(__DIR__));
    }

    /**
     * @covers Gc\Datatype\AbstractDatatype\AbstractEditor::getHelper
     */
    public function testGetHelper()
    {
        $this->assertInstanceOf('Gc\View\Helper\Partial', $this->_object->getHelper('partial'));
    }
}

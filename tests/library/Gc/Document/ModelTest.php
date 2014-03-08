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

namespace Gc\Document;

use Gc\DocumentType\Model as DocumentTypeModel;
use Gc\Layout\Model as LayoutModel;
use Gc\User\Model as UserModel;
use Gc\View\Model as ViewModel;
use Gc\Registry;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 *
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Model
     */
    protected $object;

    /**
     * @var Model
     */
    protected $parentmodel;

    /**
     * @var ViewModel
     */
    protected $view;

    /**
     * @var LayoutModel
     */
    protected $layout;

    /**
     * @var UserModel
     */
    protected $user;

    /**
     * @var DocumentTypeModel
     */
    protected $documentType;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->view = ViewModel::fromArray(
            array(
                'name' => 'View Name',
                'identifier' => 'View identifier',
                'description' => 'View Description',
                'content' => 'View Content'
            )
        );
        $this->view->save();

        $this->layout = LayoutModel::fromArray(
            array(
                'name' => 'Layout Name',
                'identifier' => 'Layout identifier',
                'description' => 'Layout Description',
                'content' => 'Layout Content'
            )
        );
        $this->layout->save();

        $this->user = UserModel::fromArray(
            array(
                'lastname' => 'User test',
                'firstname' => 'User test',
                'email' => 'pierre.rambaud86@gmail.com',
                'login' => 'test',
                'user_acl_role_id' => 1,
            )
        );

        $this->user->setPassword('test');
        $this->user->save();

        $this->documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'Document Type Name',
                'description' => 'Document Type description',
                'icon_id' => 1,
                'defaultview_id' => $this->view->getId(),
                'user_id' => $this->user->getId(),
            )
        );

        $this->documentType->save();

        $this->parentModel = Model::fromArray(
            array(
                'name' => 'Document name',
                'url_key' => 'parent',
                'status' => Model::STATUS_ENABLE,
                'show_in_nav' => true,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => 0
            )
        );
        $this->parentModel->save();

        $this->object = Model::fromArray(
            array(
                'name' => 'Document name',
                'url_key' => 'url-key',
                'status' => Model::STATUS_ENABLE,
                'show_in_nav' => true,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => $this->parentModel->getId()
            )
        );

        $this->object->save();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->object->delete();
        unset($this->object);

        $this->view->delete();
        unset($this->view);

        $this->layout->delete();
        unset($this->layout);

        $this->documentType->delete();
        unset($this->documentType);

        $this->user->delete();
        unset($this->user);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInit()
    {
        $id = $this->object->getId();
        $this->object->init($id);
        $this->assertEquals($id, $this->object->getId());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetView()
    {
        $this->assertInstanceOf('Gc\View\Model', $this->object->getView());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetLayout()
    {
        $this->assertInstanceOf('Gc\Layout\Model', $this->object->getLayout());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetDocumentType()
    {
        $this->assertInstanceOf('Gc\DocumentType\Model', $this->object->getDocumentType());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testShowInNav()
    {
        $this->object->showInNav(true);
        $this->assertTrue($this->object->showInNav());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testIsPublished()
    {
        $this->object->setStatus(Model::STATUS_ENABLE);
        $this->assertTrue($this->object->isPublished());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromArray()
    {
        $model = Model::fromArray($this->object->getData());
        $this->assertInstanceOf('Gc\Document\Model', $model);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromId()
    {
        $model = Model::fromId($this->object->getId());
        $this->assertInstanceOf('Gc\Document\Model', $model);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromFakeId()
    {
        $model = Model::fromId(1000);
        $this->assertFalse($model);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromUrlKey()
    {
        $model = Model::fromUrlKey($this->object->getUrlKey());
        $this->assertInstanceOf('Gc\Document\Model', $model);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testFromFakeUrlKey()
    {
        $model = Model::fromUrlKey($this->object->getUrlKey(), 1000);
        $this->assertFalse($model);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSave()
    {
        $this->assertInternalType('integer', (int) $this->object->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testSaveWithWrongValues()
    {
        $this->setExpectedException('Gc\Exception');
        $model = $this->object->fromArray(
            array(
                'name' => 'Document name',
                'url_key' => null,
                'status' => Model::STATUS_ENABLE,
                'show_in_nav' => true,
                'user_id' => null,
                'document_type_id' => null,
                'view_id' => null,
                'layout_id' => null,
                'parent_id' => null,
            )
        );
        $this->assertFalse($model->save());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDelete()
    {
        $this->assertTrue($this->object->delete());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteWithoutId()
    {
        $model = new Model();
        $this->assertFalse($model->delete());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testDeleteWithException()
    {
        $configuration = Registry::get('Application')->getConfig();
        if ($configuration['db']['driver'] == 'pdo_mysql') {
            $this->markTestSkipped('Mysql does not thrown exception.');
        }

        $this->setExpectedException('Gc\Exception');
        $model = new Model();
        $model->setId('test');
        $this->assertFalse($model->delete());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetUrl()
    {
        $this->assertEquals('/parent/url-key', $this->object->getUrl());
        $this->assertEquals('http:///parent/url-key', $this->object->getUrl(true));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetName()
    {
        $this->assertEquals('Document name', $this->object->getName());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetId()
    {
        $this->assertInternalType('integer', (int) $this->object->getId());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetParent()
    {
        $this->assertInstanceOf('Gc\Document\Model', $this->object->getParent());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetChildren()
    {
        $this->assertInternalType('array', $this->object->getChildren());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetAvailableChilren()
    {
        $this->assertInternalType('array', $this->object->getAvailableChildren());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetPropertyWithOutId()
    {
        $fakeModel = new Model();
        $this->assertFalse($fakeModel->getProperty('fakeproperty'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetProperty()
    {
        $this->assertFalse($this->object->getProperty('fakeproperty'));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetIcon()
    {
        $this->assertEquals('/media/icons/home.png', $this->object->getIcon());
    }
    /**
     * Test
     *
     * @return void
     */
    public function testGetEmptyIcon()
    {
        $this->object->getDocumentType()->setIconId(42000);
        $this->assertFalse($this->object->getIcon());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetIterableId()
    {
        $this->assertEquals('document_' . $this->object->getId(), $this->object->getIterableId());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testGetEditUrl()
    {
        $this->assertInternalType('string', $this->object->getEditUrl());
    }
}

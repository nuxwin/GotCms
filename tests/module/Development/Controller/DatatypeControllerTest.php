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
 * @package  ZfModules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Development\Controller;

use Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Gc\Datatype\Model as DatatypeModel;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-15 at 23:50:33.
 *
 * @group    ZfModules
 * @category Gc_Tests
 * @package  ZfModules
 */
class DatatypeControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->init();
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::indexAction
     *
     * @return void
     */
    public function testIndexAction()
    {
        $this->dispatch('/admin/development/datatype/list');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeList');
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::createAction
     *
     * @return void
     */
    public function testCreateAction()
    {
        $this->dispatch('/admin/development/datatype/create');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeCreate');
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::createAction
     *
     * @return void
     */
    public function testCreateWithInvalidPostData()
    {
        $this->dispatch(
            '/admin/development/datatype/create',
            'POST',
            array()
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeCreate');
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::createAction
     *
     * @return void
     */
    public function testCreateWithPostData()
    {
        $this->dispatch(
            '/admin/development/datatype/create',
            'POST',
            array(
                'name' => 'DatatypeCreateTest',
                'model' => 'Textstring',
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeCreate');
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::editAction
     *
     * @return void
     */
    public function testEditActionWithWrongId()
    {
        $this->dispatch('/admin/development/datatype/edit/9999');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeEdit');
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::editAction
     *
     * @return void
     */
    public function testEditAction()
    {
        $datatypeModel = DatatypeModel::fromArray(
            array(
                'name' => 'DatatypeTest',
                'model' => 'Textstring'
            )
        );
        $datatypeModel->save();

        $this->dispatch('/admin/development/datatype/edit/' . $datatypeModel->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeEdit');

        $datatypeModel->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::editAction
     *
     * @return void
     */
    public function testEditActionWithInvalidPostData()
    {
        $datatypeModel = DatatypeModel::fromArray(
            array(
                'name' => 'DatatypeTest',
                'model' => 'Textstring'
            )
        );
        $datatypeModel->save();

        $this->dispatch(
            '/admin/development/datatype/edit/' . $datatypeModel->getId(),
            'POST',
            array()
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeEdit');

        $datatypeModel->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::editAction
     *
     * @return void
     */
    public function testEditActionWithPostData()
    {
        $datatypeModel = DatatypeModel::fromArray(
            array(
                'name' => 'DatatypeTest',
                'model' => 'Textstring'
            )
        );
        $datatypeModel->save();

        $this->dispatch(
            '/admin/development/datatype/edit/' . $datatypeModel->getId(),
            'POST',
            array(
                'name' => 'DatatypeTest',
                'model' => 'Textstring',
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeEdit');

        $datatypeModel->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::deleteAction
     *
     * @return void
     */
    public function testDeleteAction()
    {
        $datatypeModel = DatatypeModel::fromArray(
            array(
                'name' => 'LayoutName',
                'model' => 'Textstring'
            )
        );
        $datatypeModel->save();

        $this->dispatch('/admin/development/datatype/delete/' . $datatypeModel->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeDelete');

        $datatypeModel->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\DatatypeController::deleteAction
     *
     * @return void
     */
    public function testDeleteActionWithInvalidId()
    {
        $this->dispatch('/admin/development/datatype/delete/9999');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('DatatypeController');
        $this->assertControllerClass('DatatypeController');
        $this->assertMatchedRouteName('datatypeDelete');
    }
}

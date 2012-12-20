<?php
namespace Datatypes\ImageCropper;

use Gc\Datatype\Model as DatatypeModel;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:42:12.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Datatypes
 */
class PrevalueEditorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PrevalueEditor
     */
    protected $_object;

    /**
     * @var DatatypeModel
     */
    protected $_datatype;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {

        $this->_datatype = DatatypeModel::fromArray(array(
            'name' => 'ImageCropperTest',
            'prevalue_value' => '',
            'model' => 'ImageCropper',
        ));
        $this->_datatype->save();
        $datatype = new Datatype();
        $datatype->load($this->_datatype);
        $this->_object = $datatype->getPrevalueEditor();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->_datatype->delete();
        unset($this->_datatype);
        unset($this->_object);
    }

    /**
     * @covers Datatypes\ImageCropper\PrevalueEditor::save
     */
    public function testSave()
    {
        $post = $this->_object->getRequest()->getPost();
        $post->set('background', '#FFFFFF');
        $post->set('resize_option', '#auto');
        $post->set('mime_list', array(
                'image/gif',
            'image/jpeg',
            'image/png',
        ));

        $post->set('size', array(
            array (
                'name' => '223x112',
                'width' => '223',
                'height' => '112',
            ),
            array (
                'name' => '',
                'width' => '',
                'height' => '',
            ),
        ));

        $this->assertNull($this->_object->save());
    }

    /**
     * @covers Datatypes\ImageCropper\PrevalueEditor::load
     */
    public function testLoad()
    {
        $this->_object->setConfig(array(
            'background' => '#FFFFFF',
            'resize_option' => 'auto',
            'mime_list' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
            ),
            'size' => array(
                array (
                    'name' => '223x112',
                    'width' => '223',
                    'height' => '112',
                ),
                array (
                    'name' => '600x300',
                    'width' => '600',
                    'height' => '300',
                ),
            ),
        ));

        $this->assertInternalType('string', $this->_object->load());
    }
}

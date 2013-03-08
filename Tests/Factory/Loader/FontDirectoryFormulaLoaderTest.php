<?php
namespace BDev\Bundle\AsseticBundle\Tests\Factory\Loader;

use Assetic\Factory\Resource\DirectoryResource;
use BDev\Bundle\AsseticBundle\Factory\Loader\FontDirectoryFormulaLoader;

class FontDirectoryFormulaLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testInput()
    {
        $fontDir = __DIR__ . '/Fixtures/fonts';
        $expected = array(
            $fontDir .'/1.eot' => array(
                array($fontDir .'/1.eot',), array(), array('output' => 'font/1.eot','debug' => false),
            ),
            $fontDir .'/1.otf' => array(
                array($fontDir .'/1.otf'), array(), array('output' => 'font/1.otf','debug' => false),
            ),
            $fontDir .'/1.svg' => array(
                array($fontDir .'/1.svg'), array(), array('output' => 'font/1.svg','debug' => false),
            ),
            $fontDir .'/1.ttf' => array(
                array($fontDir .'/1.ttf'), array(), array('output' => 'font/1.ttf','debug' => false),
            ),
            $fontDir .'/1.woff' => array(
                array($fontDir .'/1.woff'), array(), array('output' => 'font/1.woff','debug' => false),
            )
        );

        $resource = new DirectoryResource($fontDir);
        $factory = $this->getMockBuilder('Assetic\\Factory\\AssetFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $factory->expects($this->atLeastOnce())
            ->method('generateAssetName')
            ->will($this->returnCallback(function($inputs) { return $inputs[0]; }));

        $loader = new FontDirectoryFormulaLoader($factory);
        $formulae = $loader->load($resource);

        $this->assertEquals($expected, $formulae);
    }
}
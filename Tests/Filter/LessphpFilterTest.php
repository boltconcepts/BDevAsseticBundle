<?php
namespace BDev\Bundle\AsseticBundle\Tests\Filter;

use BDev\Bundle\AsseticBundle\Filter\LessphpFilter;

class LessphpFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LessphpFilter
     */
    protected $filter;

    public function setUp()
    {
        if (!class_exists('lessc')) {
            $this->markTestSkipped('LessPHP is not installed');
        }

        $this->filter = new LessphpFilter();
    }

    public function tearDown()
    {
        $this->filter = null;
    }

    public function testAddLoadPaths()
    {
        $this->assertAttributeCount(0, 'loadPaths', $this->filter);

        $dirs = array('test');
        $this->filter->addLoadPaths($dirs);
        $this->assertAttributeEquals($dirs, 'loadPaths', $this->filter);

        $dirs[] = 'test2';
        $dirs[] = 'test3';
        $this->filter->addLoadPaths(array('test2', 'test3'));
        $this->assertAttributeEquals($dirs, 'loadPaths', $this->filter);
    }
}
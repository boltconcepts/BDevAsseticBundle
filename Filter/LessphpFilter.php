<?php
namespace BDev\Bundle\AsseticBundle\Filter;

use Assetic\Filter\LessphpFilter as BaseFilter;

class LessphpFilter extends BaseFilter
{
    /**
     * Adds a load paths to the paths used by lessphp
     *
     * @param string[] $paths Load Paths
     */
    public function addLoadPaths(array $paths)
    {
        foreach ($paths as $path) {
            $this->addLoadPath($path);
        }
    }
}
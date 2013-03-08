<?php
namespace BDev\Bundle\AsseticBundle\Factory\Loader;

use Assetic\Factory\AssetFactory;
use Assetic\Factory\Loader\FormulaLoaderInterface;
use Assetic\Factory\Resource\DirectoryResource;
use Assetic\Factory\Resource\ResourceInterface;

class FontDirectoryFormulaLoader implements FormulaLoaderInterface
{
    protected $factory;

    public function __construct(AssetFactory $factory)
    {
        $this->factory = $factory;
        $this->extensionMap = array(
            'font/' => array('eot','svg','ttf','woff','otf')
        );
    }

    /**
     * Loads formulae from a resource.
     *
     * Formulae should be loaded the same regardless of the current debug
     * mode. Debug considerations should happen downstream.
     *
     * @param ResourceInterface $resource A resource
     *
     * @return array An array of formulae
     */
    public function load(ResourceInterface $resource)
    {
        if (!$resource instanceof DirectoryResource) {
            return array();
        }
        $basePath = (string)$resource;

        /** @var $files \Assetic\Factory\Resource\FileResource[] */
        $formulae = array();
        $files = $resource->getIterator();
        foreach ($files as $file) {
            $filePath = (string)$file;
            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $options = false;
            foreach ($this->extensionMap as $dir => $exts) {
                if (in_array($ext, $exts)) {
                    $options = array('output' => $dir . substr($filePath, strlen($basePath)), 'debug' => false);
                    break;
                }
            }
            if (!$options) {
                continue;
            }

            $inputs = array($filePath);
            $filters = array();

            $name = $this->factory->generateAssetName($inputs, $filters, $options);

            $formulae += array($name => array($inputs, $filters, $options));
        }
        return $formulae;
    }
}
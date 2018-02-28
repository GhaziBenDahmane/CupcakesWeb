<?php

namespace Vich\UploaderBundle\Storage;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\MountManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;

/**
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 */
class FlysystemStorage extends AbstractStorage
{
    /**
     * @var FilesystemMap
     */
    protected $mountManager;

    /**
     * Constructs a new instance of FlysystemStorage.
     *
<<<<<<< HEAD
     * @param PropertyMappingFactory $factory      The factory
     * @param MountManager           $mountManager Gaufrete filesystem factory
=======
     * @param PropertyMappingFactory $factory      The factory.
     * @param MountManager           $mountManager Gaufrete filesystem factory.
>>>>>>> anis
     */
    public function __construct(PropertyMappingFactory $factory, MountManager $mountManager)
    {
        parent::__construct($factory);

        $this->mountManager = $mountManager;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    protected function doUpload(PropertyMapping $mapping, UploadedFile $file, $dir, $name)
    {
        $fs = $this->getFilesystem($mapping);
        $path = !empty($dir) ? $dir.'/'.$name : $name;

        $stream = fopen($file->getRealPath(), 'r');
<<<<<<< HEAD
        $fs->writeStream($path, $stream, [
            'mimetype' => $file->getMimeType(),
        ]);
    }

    /**
     * {@inheritdoc}
=======
        $fs->writeStream($path, $stream, array(
            'mimetype' => $file->getMimeType(),
        ));
    }

    /**
     * {@inheritDoc}
>>>>>>> anis
     */
    protected function doRemove(PropertyMapping $mapping, $dir, $name)
    {
        $fs = $this->getFilesystem($mapping);
        $path = !empty($dir) ? $dir.'/'.$name : $name;

        try {
            return $fs->delete($path);
        } catch (FileNotFoundException $e) {
            return false;
        }
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    protected function doResolvePath(PropertyMapping $mapping, $dir, $name, $relative = false)
    {
        $fs = $this->getFilesystem($mapping);
        $path = !empty($dir) ? $dir.'/'.$name : $name;

        if ($relative) {
            return $path;
        }

        return $fs->get($path)->getPath();
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function resolveStream($obj, $fieldName, $className = null)
    {
        $path = $this->resolvePath($obj, $fieldName, $className);

        if (empty($path)) {
            return;
        }

        $mapping = $this->factory->fromField($obj, $fieldName, $className);
        $fs = $this->getFilesystem($mapping);

        return $fs->readStream($path);
    }

    /**
<<<<<<< HEAD
     * Get filesystem adapter by key.
=======
     * Get filesystem adapter by key
>>>>>>> anis
     *
     * @param string $key
     *
     * @return FilesystemInterface
     */
    protected function getFilesystem(PropertyMapping $mapping)
    {
        return $this->mountManager->getFilesystem($mapping->getUploadDestination());
    }
}

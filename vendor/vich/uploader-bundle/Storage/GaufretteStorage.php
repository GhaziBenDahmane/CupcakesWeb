<?php

namespace Vich\UploaderBundle\Storage;

use Gaufrette\Filesystem;
use Gaufrette\Adapter\MetadataSupporter;
use Gaufrette\Exception\FileNotFound;
use Knp\Bundle\GaufretteBundle\FilesystemMap;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;

/**
 * GaufretteStorage.
 *
 * @author Stefan Zerkalica <zerkalica@gmail.com>
 */
class GaufretteStorage extends AbstractStorage
{
    /**
     * @var FilesystemMap
     */
    protected $filesystemMap;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * Constructs a new instance of FileSystemStorage.
     *
<<<<<<< HEAD
     * @param PropertyMappingFactory $factory       The factory
     * @param FilesystemMap          $filesystemMap Gaufrete filesystem factory
     * @param string                 $protocol      Gaufrette stream wrapper protocol
=======
     * @param PropertyMappingFactory $factory       The factory.
     * @param FilesystemMap          $filesystemMap Gaufrete filesystem factory.
     * @param string                 $protocol      Gaufrette stream wrapper protocol.
>>>>>>> anis
     */
    public function __construct(PropertyMappingFactory $factory, FilesystemMap $filesystemMap, $protocol = 'gaufrette')
    {
        parent::__construct($factory);

        $this->filesystemMap = $filesystemMap;
<<<<<<< HEAD
        $this->protocol = $protocol;
    }

    /**
     * {@inheritdoc}
=======
        $this->protocol      = $protocol;
    }

    /**
     * {@inheritDoc}
>>>>>>> anis
     */
    protected function doUpload(PropertyMapping $mapping, UploadedFile $file, $dir, $name)
    {
        $filesystem = $this->getFilesystem($mapping);
        $path = !empty($dir) ? $dir.'/'.$name : $name;

        if ($filesystem->getAdapter() instanceof MetadataSupporter) {
<<<<<<< HEAD
            $filesystem->getAdapter()->setMetadata($path, ['contentType' => $file->getMimeType()]);
=======
            $filesystem->getAdapter()->setMetadata($path, array('contentType' => $file->getMimeType()));
>>>>>>> anis
        }

        $filesystem->write($path, file_get_contents($file->getPathname()), true);
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    protected function doRemove(PropertyMapping $mapping, $dir, $name)
    {
        $filesystem = $this->getFilesystem($mapping);
        $path = !empty($dir) ? $dir.'/'.$name : $name;

        try {
            return $filesystem->delete($path);
        } catch (FileNotFound $e) {
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
        $path = !empty($dir) ? $dir.'/'.$name : $name;

        if ($relative) {
            return $path;
        }

        return $this->protocol.'://'.$mapping->getUploadDestination().'/'.$path;
    }

    /**
<<<<<<< HEAD
     * Get filesystem adapter from the property mapping.
=======
     * Get filesystem adapter from the property mapping
>>>>>>> anis
     *
     * @param PropertyMapping $mapping
     *
     * @return Filesystem
     */
    protected function getFilesystem(PropertyMapping $mapping)
    {
        return $this->filesystemMap->get($mapping->getUploadDestination());
    }
}

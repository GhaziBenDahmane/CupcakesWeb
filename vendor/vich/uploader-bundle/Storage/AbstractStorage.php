<?php

namespace Vich\UploaderBundle\Storage;

use Vich\UploaderBundle\Exception\MappingNotFoundException;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * FileSystemStorage.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
abstract class AbstractStorage implements StorageInterface
{
    /**
<<<<<<< HEAD
     * @var PropertyMappingFactory
=======
     * @var PropertyMappingFactory $factory
>>>>>>> anis
     */
    protected $factory;

    /**
     * Constructs a new instance of FileSystemStorage.
     *
<<<<<<< HEAD
     * @param PropertyMappingFactory $factory The factory
=======
     * @param PropertyMappingFactory $factory The factory.
>>>>>>> anis
     */
    public function __construct(PropertyMappingFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
<<<<<<< HEAD
     * Do real upload.
=======
     * Do real upload
>>>>>>> anis
     *
     * @param PropertyMapping $mapping
     * @param UploadedFile    $file
     * @param string          $dir
     * @param string          $name
     *
<<<<<<< HEAD
     * @return bool
=======
     * @return boolean
>>>>>>> anis
     */
    abstract protected function doUpload(PropertyMapping $mapping, UploadedFile $file, $dir, $name);

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function upload($obj, PropertyMapping $mapping)
    {
        $file = $mapping->getFile($obj);

<<<<<<< HEAD
        if (null === $file || !($file instanceof UploadedFile)) {
            throw new \LogicException('No uploadable file found');
        }

        $name = $mapping->getUploadName($obj);
        $mapping->setFileName($obj, $name);

        $accessors = [
            'size' => 'getSize',
            'mimeType' => 'getMimeType',
            'originalName' => 'getClientOriginalName',
        ];

        foreach ($accessors as $property => $accessor) {
            $mapping->writeProperty($obj, $property, $file->$accessor());
        }

=======
        if ($file === null || !($file instanceof UploadedFile)) {
            throw new \LogicException('No uploadable file found');
        }

        // determine the file's name
        if ($mapping->hasNamer()) {
            $name = $mapping->getNamer()->name($obj, $mapping);
        } else {
            $name = $file->getClientOriginalName();
        }

        $mapping->setFileName($obj, $name);

        // determine the file's directory
>>>>>>> anis
        $dir = $mapping->getUploadDir($obj);

        $this->doUpload($mapping, $file, $dir, $name);
    }

    /**
<<<<<<< HEAD
     * Do real remove.
=======
     * Do real remove
>>>>>>> anis
     *
     * @param PropertyMapping $mapping
     * @param string          $dir
     * @param string          $name
     *
<<<<<<< HEAD
     * @return bool
=======
     * @return boolean
>>>>>>> anis
     */
    abstract protected function doRemove(PropertyMapping $mapping, $dir, $name);

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function remove($obj, PropertyMapping $mapping)
    {
        $name = $mapping->getFileName($obj);

        if (empty($name)) {
            return false;
        }

        return $this->doRemove($mapping, $mapping->getUploadDir($obj), $name);
    }

    /**
<<<<<<< HEAD
     * Do resolve path.
     *
     * @param PropertyMapping $mapping  The mapping representing the field
     * @param string          $dir      The directory in which the file is uploaded
     * @param string          $name     The file name
     * @param bool            $relative Whether the path should be relative or absolute
=======
     * Do resolve path
     *
     * @param PropertyMapping $mapping  The mapping representing the field.
     * @param string          $dir      The directory in which the file is uploaded.
     * @param string          $name     The file name.
     * @param bool            $relative Whether the path should be relative or absolute.
>>>>>>> anis
     *
     * @return string
     */
    abstract protected function doResolvePath(PropertyMapping $mapping, $dir, $name, $relative = false);

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function resolvePath($obj, $fieldName, $className = null, $relative = false)
    {
        list($mapping, $filename) = $this->getFilename($obj, $fieldName, $className);

        if (empty($filename)) {
<<<<<<< HEAD
            return;
=======
            return null;
>>>>>>> anis
        }

        return $this->doResolvePath($mapping, $mapping->getUploadDir($obj), $filename, $relative);
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function resolveUri($obj, $fieldName, $className = null)
    {
        list($mapping, $filename) = $this->getFilename($obj, $fieldName, $className);

        if (empty($filename)) {
<<<<<<< HEAD
            return;
=======
            return null;
>>>>>>> anis
        }

        $dir = $mapping->getUploadDir($obj);
        $path = !empty($dir) ? $dir.'/'.$filename : $filename;

        return $mapping->getUriPrefix().'/'.$path;
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
<<<<<<< HEAD
            return;
=======
            return null;
>>>>>>> anis
        }

        return fopen($path, 'rb');
    }

    /**
     *  note: extension point.
     */
    protected function getFilename($obj, $fieldName, $className = null)
    {
        $mapping = $this->factory->fromField($obj, $fieldName, $className);

<<<<<<< HEAD
        if (null === $mapping) {
            throw new MappingNotFoundException(sprintf('Mapping not found for field "%s"', $fieldName));
        }

        return [$mapping, $mapping->getFileName($obj)];
=======
        if ($mapping === null) {
            throw new MappingNotFoundException(sprintf('Mapping not found for field "%s"', $fieldName));
        }

        return array($mapping, $mapping->getFileName($obj));
>>>>>>> anis
    }
}

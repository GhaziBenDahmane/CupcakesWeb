<?php

namespace Vich\UploaderBundle\Injector;

use Symfony\Component\HttpFoundation\File\File;
<<<<<<< HEAD
=======

>>>>>>> anis
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Storage\StorageInterface;

/**
 * FileInjector.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class FileInjector implements FileInjectorInterface
{
    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * Constructs a new instance of FileInjector.
     *
<<<<<<< HEAD
     * @param StorageInterface $storage Storage
=======
     * @param StorageInterface $storage Storage.
>>>>>>> anis
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function injectFile($obj, PropertyMapping $mapping)
    {
        $path = $this->storage->resolvePath($obj, $mapping->getFilePropertyName());

<<<<<<< HEAD
        if (null !== $path) {
=======
        if ($path !== null) {
>>>>>>> anis
            $mapping->setFile($obj, new File($path, false));
        }
    }
}

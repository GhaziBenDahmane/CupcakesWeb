<?php

namespace Vich\UploaderBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Vich\UploaderBundle\Storage\StorageInterface;

/**
 * UploaderHelper.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class UploaderHelper extends Helper
{
    /**
<<<<<<< HEAD
     * @var StorageInterface
=======
     * @var StorageInterface $storage
>>>>>>> anis
     */
    protected $storage;

    /**
     * Constructs a new instance of UploaderHelper.
     *
<<<<<<< HEAD
     * @param StorageInterface $storage The storage
=======
     * @param StorageInterface $storage The storage.
>>>>>>> anis
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Gets the helper name.
     *
     * @return string The name
     */
    public function getName()
    {
        return 'vich_uploader';
    }

    /**
     * Gets the public path for the file associated with the
     * object.
     *
<<<<<<< HEAD
     * @param object|array $obj       The object
     * @param string       $fieldName The field name
     * @param string       $className The object's class. Mandatory if $obj can't be used to determine it
     *
     * @return string|null The public asset path or null if file not stored
=======
     * @param object $obj       The object.
     * @param string $fieldName The field name.
     * @param string $className The object's class. Mandatory if $obj can't be used to determine it.
     *
     * @return string The public asset path.
>>>>>>> anis
     */
    public function asset($obj, $fieldName, $className = null)
    {
        return $this->storage->resolveUri($obj, $fieldName, $className);
    }
}

<?php

namespace Vich\UploaderBundle\Handler;

use Vich\UploaderBundle\Exception\MappingNotFoundException;
<<<<<<< HEAD
use Vich\UploaderBundle\Mapping\PropertyMapping;
=======
>>>>>>> anis
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;
use Vich\UploaderBundle\Storage\StorageInterface;

/**
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
abstract class AbstractHandler
{
    /**
     * @var PropertyMappingFactory
     */
    protected $factory;

    /**
<<<<<<< HEAD
     * @var StorageInterface
=======
     * @var StorageInterface $storage
>>>>>>> anis
     */
    protected $storage;

    /**
<<<<<<< HEAD
     * @param PropertyMappingFactory $factory The mapping factory
     * @param StorageInterface       $storage The storage
=======
     * @param PropertyMappingFactory $factory The mapping factory.
     * @param StorageInterface       $storage The storage.
>>>>>>> anis
     */
    public function __construct(PropertyMappingFactory $factory, StorageInterface $storage)
    {
        $this->factory = $factory;
        $this->storage = $storage;
    }

<<<<<<< HEAD
    /**
     * @param object|array $obj
     * @param string       $fieldName
     * @param string|null  $className
     *
     * @return PropertyMapping|null
     */
=======
>>>>>>> anis
    protected function getMapping($obj, $fieldName, $className = null)
    {
        $mapping = $this->factory->fromField($obj, $fieldName, $className);

<<<<<<< HEAD
        if (null === $mapping) {
=======
        if ($mapping === null) {
>>>>>>> anis
            throw new MappingNotFoundException(sprintf('Mapping not found for field "%s"', $fieldName));
        }

        return $mapping;
    }
}

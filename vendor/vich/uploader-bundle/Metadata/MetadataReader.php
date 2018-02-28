<?php

namespace Vich\UploaderBundle\Metadata;

use Metadata\AdvancedMetadataFactoryInterface;
<<<<<<< HEAD
use Vich\UploaderBundle\Exception\MappingNotFoundException;
=======
>>>>>>> anis

/**
 * MetadataReader.
 *
 * Exposes a simple interface to read objects metadata.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class MetadataReader
{
    /**
<<<<<<< HEAD
     * @var AdvancedMetadataFactoryInterface
=======
     * @var AdvancedMetadataFactoryInterface $reader
>>>>>>> anis
     */
    protected $reader;

    /**
     * Constructs a new instance of the MetadataReader.
     *
<<<<<<< HEAD
     * @param AdvancedMetadataFactoryInterface $reader The "low-level" metadata reader
=======
     * @param AdvancedMetadataFactoryInterface $reader The "low-level" metadata reader.
>>>>>>> anis
     */
    public function __construct(AdvancedMetadataFactoryInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Tells if the given class is uploadable.
     *
<<<<<<< HEAD
     * @param string $class   The class name to test (FQCN)
     * @param string $mapping If given, also checks that the object has the given mapping
=======
     * @param string $class   The class name to test (FQCN).
     * @param string $mapping If given, also checks that the object has the given mapping.
>>>>>>> anis
     *
     * @return bool
     */
    public function isUploadable($class, $mapping = null)
    {
        $metadata = $this->reader->getMetadataForClass($class);

<<<<<<< HEAD
        if (null === $metadata) {
            return false;
        }

        if (null === $mapping) {
=======
        if ($metadata === null) {
            return false;
        } elseif ($mapping === null) {
>>>>>>> anis
            return true;
        }

        foreach ($this->getUploadableFields($class) as $fieldMetadata) {
            if ($fieldMetadata['mapping'] === $mapping) {
                return true;
            }
        }

        return false;
    }

    /**
     * Search for all uploadable classes.
     *
<<<<<<< HEAD
     * @return array A list of uploadable class names
=======
     * @return array A list of uploadable class names.
>>>>>>> anis
     */
    public function getUploadableClasses()
    {
        return $this->reader->getAllClassNames();
    }

    /**
     * Attempts to read the uploadable fields.
     *
<<<<<<< HEAD
     * @param string $class   The class name to test (FQCN)
     * @param string $mapping If given, also checks that the object has the given mapping
     *
     * @return array A list of uploadable fields
     *
     * @throws MappingNotFoundException
     */
    public function getUploadableFields(string $class, string $mapping = null): array
    {
        if (null === $metadata = $this->reader->getMetadataForClass($class)) {
            throw MappingNotFoundException::createNotFoundForClass($mapping ?? '', $class);
        }
        $uploadableFields = [];
=======
     * @param string $class The class name to test (FQCN).
     *
     * @return array A list of uploadable fields.
     */
    public function getUploadableFields($class)
    {
        $metadata = $this->reader->getMetadataForClass($class);
        $uploadableFields = array();
>>>>>>> anis

        foreach ($metadata->classMetadata as $classMetadata) {
            $uploadableFields = array_merge($uploadableFields, $classMetadata->fields);
        }

<<<<<<< HEAD
        if (null !== $mapping) {
            $uploadableFields = array_filter($uploadableFields, function ($fieldMetadata) use ($mapping) {
                return $fieldMetadata['mapping'] === $mapping;
            });
        }

=======
>>>>>>> anis
        return $uploadableFields;
    }

    /**
     * Attempts to read the mapping of a specified property.
     *
<<<<<<< HEAD
     * @param string $class The class name to test (FQCN)
     * @param string $field The field
     *
     * @return null|array The field mapping
=======
     * @param string $class The class name to test (FQCN).
     * @param string $field The field
     *
     * @return null|array The field mapping.
>>>>>>> anis
     */
    public function getUploadableField($class, $field)
    {
        $fieldsMetadata = $this->getUploadableFields($class);

        return isset($fieldsMetadata[$field]) ? $fieldsMetadata[$field] : null;
    }
}

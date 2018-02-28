<?php

namespace Vich\UploaderBundle\Metadata\Driver;

use Doctrine\Common\Annotations\Reader as AnnotationReader;
<<<<<<< HEAD
use Metadata\Driver\AdvancedDriverInterface;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;
use Vich\UploaderBundle\Metadata\ClassMetadata;

/**
 * @author Kévin Gomez <contact@kevingomez.fr>
 * @author Konstantin Myakshin <koc-dp@yandex.ru>
 */
class AnnotationDriver implements AdvancedDriverInterface
{
    /**
     * @deprecated
     */
    const UPLOADABLE_ANNOTATION = Uploadable::class;

    /**
     * @deprecated
     */
    const UPLOADABLE_FIELD_ANNOTATION = UploadableField::class;
=======
use Metadata\Driver\DriverInterface;

use Vich\UploaderBundle\Metadata\ClassMetadata;

/**
 * Annotation driver
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class AnnotationDriver implements DriverInterface
{
    const UPLOADABLE_ANNOTATION         = 'Vich\UploaderBundle\Mapping\Annotation\Uploadable';
    const UPLOADABLE_FIELD_ANNOTATION   = 'Vich\UploaderBundle\Mapping\Annotation\UploadableField';
>>>>>>> anis

    protected $reader;

    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    public function loadMetadataForClass(\ReflectionClass $class)
    {
        if (!$this->isUploadable($class)) {
<<<<<<< HEAD
            return;
        }

        $classMetadata = new ClassMetadata($class->name);
        $classMetadata->fileResources[] = $class->getFileName();

        foreach ($class->getProperties() as $property) {
            $uploadableField = $this->reader->getPropertyAnnotation($property, UploadableField::class);
            if (null === $uploadableField) {
                continue;
            }
            /* @var $uploadableField UploadableField */
            //TODO: try automatically determinate target fields if embeddable used

            $fieldMetadata = [
                'mapping' => $uploadableField->getMapping(),
                'propertyName' => $property->getName(),
                'fileNameProperty' => $uploadableField->getFileNameProperty(),
                'size' => $uploadableField->getSize(),
                'mimeType' => $uploadableField->getMimeType(),
                'originalName' => $uploadableField->getOriginalName(),
            ];

            //TODO: store UploadableField object instead of array
            $classMetadata->fields[$property->getName()] = $fieldMetadata;
        }

        return $classMetadata;
    }

    public function getAllClassNames()
    {
        return [];
=======
            return null;
        }

        $metadata = new ClassMetadata($class->name);

        foreach ($class->getProperties() as $property) {
            $uploadableField = $this->reader->getPropertyAnnotation($property, self::UPLOADABLE_FIELD_ANNOTATION);
            if ($uploadableField === null) {
                continue;
            }

            $fieldMetadata = array(
                'mapping'           => $uploadableField->getMapping(),
                'propertyName'      => $property->getName(),
                'fileNameProperty'  => $uploadableField->getFileNameProperty(),
            );

            $metadata->fields[$property->getName()] = $fieldMetadata;
        }

        return $metadata;
>>>>>>> anis
    }

    protected function isUploadable(\ReflectionClass $class)
    {
<<<<<<< HEAD
        return null !== $this->reader->getClassAnnotation($class, Uploadable::class);
=======
        return $this->reader->getClassAnnotation($class, self::UPLOADABLE_ANNOTATION) !== null;
>>>>>>> anis
    }
}

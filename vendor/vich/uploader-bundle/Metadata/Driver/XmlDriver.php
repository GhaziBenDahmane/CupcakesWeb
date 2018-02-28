<?php

namespace Vich\UploaderBundle\Metadata\Driver;

<<<<<<< HEAD
use Metadata\Driver\AbstractFileDriver;
use Symfony\Component\Config\Util\XmlUtils;
use Vich\UploaderBundle\Metadata\ClassMetadata;

/**
 * @author Kévin Gomez <contact@kevingomez.fr>
 * @author Konstantin Myakshin <koc-dp@yandex.ru>
 */
class XmlDriver extends AbstractFileDriver
{
    protected function loadMetadataFromFile(\ReflectionClass $class, $file)
    {
        $elem = XmlUtils::loadFile($file);
        $elem = simplexml_import_dom($elem);

        $className = $this->guessClassName($file, $elem, $class);
        $classMetadata = new ClassMetadata($className);
        $classMetadata->fileResources[] = $file;
        $classMetadata->fileResources[] = $class->getFileName();

        foreach ($elem->children() as $field) {
            $fieldMetadata = [
                'mapping' => (string) $field->attributes()->mapping,
                'propertyName' => (string) $field->attributes()->name,
                'fileNameProperty' => (string) $field->attributes()->filename_property,
                'size' => (string) $field->attributes()->size,
                'mimeType' => (string) $field->attributes()->mime_type,
                'originalName' => (string) $field->attributes()->original_name,
            ];

            $classMetadata->fields[(string) $field->attributes()->name] = $fieldMetadata;
        }

        return $classMetadata;
    }

    /**
     * {@inheritdoc}
=======
use Vich\UploaderBundle\Metadata\ClassMetadata;

/**
 * Xml driver
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class XmlDriver extends AbstractFileDriver
{
    protected function loadMetadataFromFile($file, \ReflectionClass $class = null)
    {
        $elem = $this->loadMappingFile($file);

        $className = $this->guessClassName($file, $elem, $class);
        $metadata = new ClassMetadata($className);

        foreach ($elem->children() as $field) {
            $fieldMetadata = array(
                'mapping'           => (string) $field->attributes()->mapping,
                'propertyName'      => (string) $field->attributes()->name,
                'fileNameProperty'  => (string) $field->attributes()->filename_property,
            );

            $metadata->fields[(string) $field->attributes()->name] = $fieldMetadata;
        }

        return $metadata;
    }

    protected function getClassNameFromFile($file)
    {
        return $this->guessClassName($file, $this->loadMappingFile($file));
    }

    protected function loadMappingFile($file)
    {
        $previous = libxml_use_internal_errors(true);
        $elem = simplexml_load_file($file);
        libxml_use_internal_errors($previous);

        if (false === $elem) {
            throw new \RuntimeException(libxml_get_last_error());
        }

        return $elem;
    }

    /**
     * {@inheritDoc}
>>>>>>> anis
     */
    protected function getExtension()
    {
        return 'xml';
    }

    protected function guessClassName($file, \SimpleXMLElement $elem, \ReflectionClass $class = null)
    {
<<<<<<< HEAD
        if (null === $class) {
=======
        if ($class === null) {
>>>>>>> anis
            return (string) $elem->attributes()->class;
        }

        if ($class->name !== (string) $elem->attributes()->class) {
            throw new \RuntimeException(sprintf('Expected metadata for class %s to be defined in %s.', $class->name, $file));
        }

        return $class->name;
    }
}

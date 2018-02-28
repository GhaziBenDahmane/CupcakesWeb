<?php

namespace Vich\UploaderBundle\Metadata\Driver;

<<<<<<< HEAD
use Metadata\Driver\AbstractFileDriver;
use Symfony\Component\Yaml\Yaml as YmlParser;
use Vich\UploaderBundle\Metadata\ClassMetadata;

/**
 * @author Kévin Gomez <contact@kevingomez.fr>
 * @author Konstantin Myakshin <koc-dp@yandex.ru>
=======
use Symfony\Component\Yaml\Yaml as YmlParser;

use Vich\UploaderBundle\Metadata\ClassMetadata;

/**
 * Yaml driver
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
>>>>>>> anis
 */
class YamlDriver extends AbstractFileDriver
{
    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    protected function loadMetadataFromFile(\ReflectionClass $class, $file)
    {
        $config = $this->loadMappingFile($file);
        $className = $this->guessClassName($file, $config, $class);
        $classMetadata = new ClassMetadata($className);
        $classMetadata->fileResources[] = $file;
        $classMetadata->fileResources[] = $class->getFileName();

        foreach ($config[$className] as $field => $mappingData) {
            $fieldMetadata = [
                'mapping' => $mappingData['mapping'],
                'propertyName' => $field,
                'fileNameProperty' => isset($mappingData['filename_property']) ? $mappingData['filename_property'] : null,
                'size' => isset($mappingData['size']) ? $mappingData['size'] : null,
                'mimeType' => isset($mappingData['mime_type']) ? $mappingData['mime_type'] : null,
                'originalName' => isset($mappingData['original_name']) ? $mappingData['original_name'] : null,
            ];

            $classMetadata->fields[$field] = $fieldMetadata;
        }

        return $classMetadata;
=======
     * {@inheritDoc}
     */
    protected function loadMetadataFromFile($file, \ReflectionClass $class = null)
    {
        $config = $this->loadMappingFile($file);
        $className = $this->guessClassName($file, $config, $class);
        $metadata = new ClassMetadata($className);

        foreach ($config[$className] as $field => $mappingData) {
            $fieldMetadata = array(
                'mapping'           => $mappingData['mapping'],
                'propertyName'      => $field,
                'fileNameProperty'  => isset($mappingData['filename_property']) ? $mappingData['filename_property'] : null,
            );

            $metadata->fields[$field] = $fieldMetadata;
        }

        return $metadata;
    }

    protected function getClassNameFromFile($file)
    {
        return $this->guessClassName($file, $this->loadMappingFile($file));
>>>>>>> anis
    }

    protected function loadMappingFile($file)
    {
        return YmlParser::parse(file_get_contents($file));
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    protected function getExtension()
    {
        return 'yml';
    }

    protected function guessClassName($file, array $config, \ReflectionClass $class = null)
    {
<<<<<<< HEAD
        if (null === $class) {
=======
        if ($class === null) {
>>>>>>> anis
            return current(array_keys($config));
        }

        if (!isset($config[$class->name])) {
            throw new \RuntimeException(sprintf('Expected metadata for class %s to be defined in %s.', $class->name, $file));
        }

        return $class->name;
    }
}

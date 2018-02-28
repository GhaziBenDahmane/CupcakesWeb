<?php

namespace Vich\UploaderBundle\Mapping\Annotation;

/**
 * UploadableField.
 *
 * @Annotation
 * @Target({"PROPERTY"})
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class UploadableField
{
    /**
<<<<<<< HEAD
     * @var string
=======
     * @var string $mapping
>>>>>>> anis
     */
    protected $mapping;

    /**
<<<<<<< HEAD
     * @var string
     */
    protected $fileNameProperty;
    //TODO: replace "fileNameProperty" with just "name"

    /**
     * @var string
     */
    protected $size;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var string
     */
    protected $originalName;
=======
     * @var string $fileNameProperty
     */
    protected $fileNameProperty;
>>>>>>> anis

    /**
     * Constructs a new instance of UploadableField.
     *
<<<<<<< HEAD
     * @param array $options The options
     *
=======
     * @param  array                     $options The options.
>>>>>>> anis
     * @throws \InvalidArgumentException
     */
    public function __construct(array $options)
    {
<<<<<<< HEAD
        if (empty($options['mapping'])) {
            throw new \InvalidArgumentException('The "mapping" attribute of UploadableField is required.');
        }

        foreach ($options as $property => $value) {
            if (!property_exists($this, $property)) {
                throw new \RuntimeException(sprintf('Unknown key "%s" for annotation "@%s".', $property, get_class($this)));
            }

            $this->$property = $value;
=======
        if (isset($options['mapping'])) {
            $this->mapping = $options['mapping'];
        } else {
            throw new \InvalidArgumentException('The "mapping" attribute of UploadableField is required.');
        }

        if (isset($options['fileNameProperty'])) {
            $this->fileNameProperty = $options['fileNameProperty'];
>>>>>>> anis
        }
    }

    /**
     * Gets the mapping name.
     *
<<<<<<< HEAD
     * @return string The mapping name
=======
     * @return string The mapping name.
>>>>>>> anis
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Gets the file name property.
     *
<<<<<<< HEAD
     * @return string The file name property
=======
     * @return string The file name property.
>>>>>>> anis
     */
    public function getFileNameProperty()
    {
        return $this->fileNameProperty;
    }
<<<<<<< HEAD

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }
=======
>>>>>>> anis
}

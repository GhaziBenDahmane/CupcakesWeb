<?php

namespace Vich\UploaderBundle\Metadata;

use Metadata\ClassMetadata as BaseClassMetadata;

class ClassMetadata extends BaseClassMetadata
{
<<<<<<< HEAD
    public $fields = [];

    public function serialize()
    {
        return serialize([
            $this->fields,
            parent::serialize(),
        ]);
=======
    public $fields = array();

    public function serialize()
    {
        return serialize(array(
            $this->name,
            $this->methodMetadata,
            $this->propertyMetadata,
            $this->fileResources,
            $this->createdAt,
            $this->fields
        ));
>>>>>>> anis
    }

    public function unserialize($str)
    {
        list(
<<<<<<< HEAD
            $this->fields,
            $parentStr
            ) = unserialize($str);

        parent::unserialize($parentStr);
=======
            $this->name,
            $this->methodMetadata,
            $this->propertyMetadata,
            $this->fileResources,
            $this->createdAt,
            $this->fields
        ) = unserialize($str);

        $this->reflection = new \ReflectionClass($this->name);
>>>>>>> anis
    }
}

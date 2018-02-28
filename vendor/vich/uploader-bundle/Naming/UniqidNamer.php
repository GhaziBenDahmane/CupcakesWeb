<?php

namespace Vich\UploaderBundle\Naming;

use Vich\UploaderBundle\Mapping\PropertyMapping;

/**
<<<<<<< HEAD
 * UniqidNamer.
=======
 * UniqidNamer
>>>>>>> anis
 *
 * @author Emmanuel Vella <vella.emmanuel@gmail.com>
 */
class UniqidNamer implements NamerInterface
{
    use Polyfill\FileExtensionTrait;

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function name($object, PropertyMapping $mapping)
    {
        $file = $mapping->getFile($object);
<<<<<<< HEAD
        $name = str_replace('.', '', uniqid('', true));
=======
        $name = uniqid();
>>>>>>> anis

        if ($extension = $this->getExtension($file)) {
            $name = sprintf('%s.%s', $name, $extension);
        }

        return $name;
    }
}

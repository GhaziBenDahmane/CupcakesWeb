<?php

namespace Vich\UploaderBundle\Naming;

use Symfony\Component\HttpFoundation\File\UploadedFile;
<<<<<<< HEAD
=======

>>>>>>> anis
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Util\Transliterator;

/**
<<<<<<< HEAD
 * OrignameNamer.
=======
 * OrignameNamer
>>>>>>> anis
 *
 * @author Ivan Borzenkov <ivan.borzenkov@gmail.com>
 */
class OrignameNamer implements NamerInterface, ConfigurableInterface
{
    /**
     * @var bool
     */
    private $transliterate = false;

    /**
     * @param array $options Options for this namer. The following options are accepted:
<<<<<<< HEAD
     *                       - transliterate: whether the filename should be transliterated or not
=======
     *                         - transliterate: whether the filename should be transliterated or not.
>>>>>>> anis
     */
    public function configure(array $options)
    {
        $this->transliterate = isset($options['transliterate']) ? (bool) $options['transliterate'] : $this->transliterate;
    }

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
        $name = $file->getClientOriginalName();

        if ($this->transliterate) {
            $name = Transliterator::transliterate($name);
        }

<<<<<<< HEAD
        /* @var $file UploadedFile */
=======
        /** @var $file UploadedFile */
>>>>>>> anis

        return uniqid().'_'.$name;
    }
}

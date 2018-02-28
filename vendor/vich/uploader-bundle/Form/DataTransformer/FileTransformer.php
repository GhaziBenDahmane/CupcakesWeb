<?php

namespace Vich\UploaderBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class FileTransformer implements DataTransformerInterface
{
    public function transform($file)
    {
<<<<<<< HEAD
        return [
            'file' => $file,
        ];
=======
        return array(
            'file' => $file,
        );
>>>>>>> anis
    }

    public function reverseTransform($data)
    {
        return $data['file'];
    }
}

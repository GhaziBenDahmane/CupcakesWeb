<?php

namespace Vich\UploaderBundle\Naming;

/**
 * ConfigurableInterface.
 *
 * Allows namers to receive configuration options.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
interface ConfigurableInterface
{
    /**
     * Injects configuration options.
     *
<<<<<<< HEAD
     * @param array $options The options
=======
     * @param array $options The options.
>>>>>>> anis
     */
    public function configure(array $options);
}

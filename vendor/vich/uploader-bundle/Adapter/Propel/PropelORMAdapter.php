<?php

namespace Vich\UploaderBundle\Adapter\Propel;

use Vich\UploaderBundle\Adapter\AdapterInterface;

/**
 * Propel adapter.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class PropelORMAdapter implements AdapterInterface
{
    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function getObjectFromArgs($event)
    {
        return $event->getSubject();
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
=======
     * {@inheritDoc}
>>>>>>> anis
     */
    public function recomputeChangeSet($event)
    {
    }
}

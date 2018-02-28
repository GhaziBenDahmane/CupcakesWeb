<?php

namespace Vich\UploaderBundle\Adapter\PHPCR;

use Vich\UploaderBundle\Adapter\AdapterInterface;

/**
<<<<<<< HEAD
=======
 * PHPCRAdapter.
 *
>>>>>>> anis
 * @author Ben Glassman <bglassman@gmail.com>
 */
class PHPCRAdapter implements AdapterInterface
{
    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function getObjectFromArgs($event)
    {
        return $event->getObject();
    }

    /**
     * {@inheritdoc}
=======
     * {@inheritDoc}
     */
    public function getObjectFromArgs($event)
    {
        return $event->getEntity();
    }

    /**
     * {@inheritDoc}
>>>>>>> anis
     */
    public function recomputeChangeSet($event)
    {
        $object = $this->getObjectFromArgs($event);

        $dm = $event->getObjectManager();
        $uow = $dm->getUnitOfWork();
        $uow->computeSingleDocumentChangeSet($object);
    }
}

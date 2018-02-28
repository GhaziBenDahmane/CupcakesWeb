<?php

namespace Vich\UploaderBundle\EventListener\Doctrine;

use Doctrine\Common\EventArgs;
use Doctrine\Common\Persistence\Proxy;

/**
<<<<<<< HEAD
 * RemoveListener.
=======
 * RemoveListener
>>>>>>> anis
 *
 * Listen to the remove event to delete files accordingly.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class RemoveListener extends BaseListener
{
    /**
     * The events the listener is subscribed to.
     *
<<<<<<< HEAD
     * @return array The array of events
     */
    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'postRemove',
        ];
=======
     * @return array The array of events.
     */
    public function getSubscribedEvents()
    {
        return array(
            'preRemove',
            'postRemove',
        );
>>>>>>> anis
    }

    /**
     * Ensures a proxy will be usable in the postRemove.
     *
<<<<<<< HEAD
     * @param EventArgs $event The event
     */
    public function preRemove(EventArgs $event)
    {
        $object = $this->adapter->getObjectFromArgs($event);

        if ($this->isUploadable($object) && $object instanceof Proxy) {
            $object->__load();
        }
    }

    /**
     * @param EventArgs $event The event
=======
     * @param EventArgs $event The event.
     */
    public function preRemove(EventArgs $event)
    {
         $object = $this->adapter->getObjectFromArgs($event);

         if ($this->isUploadable($object) && $object instanceof Proxy) {
             $object->__load();
         }
    }

    /**
     * @param EventArgs $event The event.
>>>>>>> anis
     */
    public function postRemove(EventArgs $event)
    {
        $object = $this->adapter->getObjectFromArgs($event);

        if (!$this->isUploadable($object)) {
            return;
        }

        foreach ($this->getUploadableFields($object) as $field) {
            $this->handler->remove($object, $field);
        }
    }
}

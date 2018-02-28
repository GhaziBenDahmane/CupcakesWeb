<?php

namespace Vich\UploaderBundle\EventListener\Propel;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
<<<<<<< HEAD
 * UploadListener.
=======
 * UploadListener
>>>>>>> anis
 *
 * Handles file uploads.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class UploadListener extends BaseListener
{
    /**
     * The events the listener is subscribed to.
     *
<<<<<<< HEAD
     * @return array The array of events
     */
    public static function getSubscribedEvents()
    {
        return [
            'propel.pre_insert' => 'onUpload',
            'propel.pre_update' => 'onUpload',
        ];
    }

    /**
     * @param GenericEvent $event The event
=======
     * @return array The array of events.
     */
    public static function getSubscribedEvents()
    {
        return array(
            'propel.pre_insert' => 'onUpload',
            'propel.pre_update' => 'onUpload',
        );
    }

    /**
     * @param GenericEvent $event The event.
>>>>>>> anis
     */
    public function onUpload(GenericEvent $event)
    {
        $object = $this->adapter->getObjectFromArgs($event);

        foreach ($this->getUploadableFields($object) as $field) {
            $this->handler->upload($object, $field);
        }
    }
}

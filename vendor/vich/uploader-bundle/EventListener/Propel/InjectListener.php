<?php

namespace Vich\UploaderBundle\EventListener\Propel;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
<<<<<<< HEAD
 * InjectListener.
=======
 * InjectListener
>>>>>>> anis
 *
 * Listen to the load event in order to inject File objects.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class InjectListener extends BaseListener
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
            'propel.post_hydrate' => 'onHydrate',
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
            'propel.post_hydrate' => 'onHydrate',
        );
    }

    /**
     * @param GenericEvent $event The event.
>>>>>>> anis
     */
    public function onHydrate(GenericEvent $event)
    {
        $object = $this->adapter->getObjectFromArgs($event);

        foreach ($this->getUploadableFields($object) as $field) {
            $this->handler->inject($object, $field);
        }
    }
}

<?php

namespace Vich\UploaderBundle\Adapter;

/**
 * AdapterInterface.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
interface AdapterInterface
{
    /**
     * Gets the mapped object from an event.
     *
<<<<<<< HEAD
     * @param object $event The event
     *
     * @return object The mapped object
=======
     * @param  object $event The event.
     * @return object The mapped object.
>>>>>>> anis
     */
    public function getObjectFromArgs($event);

    /**
     * Recomputes the change set for the object.
     *
<<<<<<< HEAD
     * @param object $event The event
=======
     * @param object $event The event.
>>>>>>> anis
     */
    public function recomputeChangeSet($event);
}

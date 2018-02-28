<?php

namespace Vich\UploaderBundle\Event;

/**
 * Contains all the events triggered by the bundle.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
final class Events
{
    /**
     * Triggered before a file upload is handled.
     *
     * @note This event is the same for new and old entities.
     *
     * @Event("Vich\UploaderBundle\Event\Event")
     */
<<<<<<< HEAD
    const PRE_UPLOAD = 'vich_uploader.pre_upload';
=======
    const PRE_UPLOAD    = 'vich_uploader.pre_upload';
>>>>>>> anis

    /**
     * Triggered right after a file upload is handled.
     *
     * @note This event is the same for new and old entities.
     *
     * @Event("Vich\UploaderBundle\Event\Event")
     */
<<<<<<< HEAD
    const POST_UPLOAD = 'vich_uploader.post_upload';
=======
    const POST_UPLOAD   = 'vich_uploader.post_upload';
>>>>>>> anis

    /**
     * Triggered before a file is injected into an entity.
     *
     * @Event("Vich\UploaderBundle\Event\Event")
     */
<<<<<<< HEAD
    const PRE_INJECT = 'vich_uploader.pre_inject';
=======
    const PRE_INJECT    = 'vich_uploader.pre_inject';
>>>>>>> anis

    /**
     * Triggered after a file is injected into an entity.
     *
     * @Event("Vich\UploaderBundle\Event\Event")
     */
<<<<<<< HEAD
    const POST_INJECT = 'vich_uploader.post_inject';
=======
    const POST_INJECT   = 'vich_uploader.post_inject';
>>>>>>> anis

    /**
     * Triggered before a file is removed.
     *
     * @Event("Vich\UploaderBundle\Event\Event")
     */
<<<<<<< HEAD
    const PRE_REMOVE = 'vich_uploader.pre_remove';
=======
    const PRE_REMOVE    = 'vich_uploader.pre_remove';
>>>>>>> anis

    /**
     * Triggered after a file is removed.
     *
     * @Event("Vich\UploaderBundle\Event\Event")
     */
<<<<<<< HEAD
    const POST_REMOVE = 'vich_uploader.post_remove';
=======
    const POST_REMOVE   = 'vich_uploader.post_remove';
>>>>>>> anis
}

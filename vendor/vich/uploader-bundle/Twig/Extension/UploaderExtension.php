<?php

namespace Vich\UploaderBundle\Twig\Extension;

use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * UploaderExtension.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class UploaderExtension extends \Twig_Extension
{
    /**
<<<<<<< HEAD
     * @var UploaderHelper
=======
     * @var UploaderHelper $helper
>>>>>>> anis
     */
    private $helper;

    /**
     * Constructs a new instance of UploaderExtension.
     *
     * @param UploaderHelper $helper
     */
    public function __construct(UploaderHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     */
    public function getName()
    {
        return 'vich_uploader';
    }

    /**
     * Returns a list of twig functions.
     *
     * @return array An array
     */
    public function getFunctions()
    {
<<<<<<< HEAD
        return [
            new \Twig_SimpleFunction('vich_uploader_asset', [$this, 'asset']),
        ];
=======
        return array(
            new \Twig_SimpleFunction('vich_uploader_asset', array($this, 'asset')),
        );
>>>>>>> anis
    }

    /**
     * Gets the public path for the file associated with the uploadable
     * object.
     *
<<<<<<< HEAD
     * @param object $obj       The object
     * @param string $fieldName The field name
     * @param string $className The object's class. Mandatory if $obj can't be used to determine it
     *
     * @return string|null The public path or null if file not stored
=======
     * @param object $obj       The object.
     * @param string $fieldName The field name.
     * @param string $className The object's class. Mandatory if $obj can't be used to determine it.
     *
     * @return string The public path.
>>>>>>> anis
     */
    public function asset($obj, $fieldName, $className = null)
    {
        return $this->helper->asset($obj, $fieldName, $className);
    }
}

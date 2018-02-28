<?php

namespace Vich\UploaderBundle;

<<<<<<< HEAD
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
=======
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

>>>>>>> anis
use Vich\UploaderBundle\DependencyInjection\Compiler\RegisterPropelModelsPass;

/**
 * VichUploaderBundle.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class VichUploaderBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

<<<<<<< HEAD
        $container->addCompilerPass(new RegisterPropelModelsPass(), PassConfig::TYPE_BEFORE_REMOVING);
=======
        $container->addCompilerPass(new RegisterPropelModelsPass());
>>>>>>> anis
    }
}

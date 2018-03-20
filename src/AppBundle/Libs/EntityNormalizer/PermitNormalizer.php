<?php

namespace AppBundle\Libs\EntityNormalizer;

use AppBundle\Entity\Usuario;
use AppBundle\Libs\Normalizer\AbstractNormalizer;
use AppBundle\Libs\Decorator\CustomDecorator;

/**
 * Description of PermitNormalizer
 *
 * @author code
 */
class PermitNormalizer extends AbstractNormalizer implements \Symfony\Component\DependencyInjection\ContainerAwareInterface {

    private $container;

    public function normalizeObject( $object, $prototype) {

        $obj = array();

        $normalice = $this->container->get('manager.json');

        switch ($prototype) {
            case CustomDecorator::DEFAULT_DECORATOR:
                $obj['id'] = $object->getId();
                $obj['createdAt'] = $object->getCreatedAt();
                $obj['updatedAt'] = $object->getUpdatedAt();
                $obj['user'] = $normalice->normalize('normalizer.user', $object->getUser(), CustomDecorator::SIMPLE);
                $obj['type'] = $normalice->normalize('normalizer.permittype', $object->getType(), CustomDecorator::DEFAULT_DECORATOR);
                break;
        }

        return $obj;
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }

}

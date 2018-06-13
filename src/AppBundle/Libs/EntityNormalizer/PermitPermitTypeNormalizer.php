<?php

namespace AppBundle\Libs\EntityNormalizer;

use AppBundle\Entity\Usuario;
use AppBundle\Libs\Normalizer\AbstractNormalizer;
use AppBundle\Libs\Decorator\CustomDecorator;

/**
 * Description of PermitPermitTypeNormalizer
 *
 * @author code
 */
class PermitPermitTypeNormalizer extends AbstractNormalizer implements \Symfony\Component\DependencyInjection\ContainerAwareInterface {

    private $container;

    public function normalizeObject( $object, $prototype) {

        $obj = array();

        $normalice = $this->container->get('manager.json');

        switch ($prototype) {
            case CustomDecorator::DEFAULT_DECORATOR:
                $obj['id'] = $object->getId();
                $obj['descriptionOfWork'] = $object->getDescriptionOfWork();
                $obj['estimateValue'] = $object->getEstimateValue();
                $obj['area'] = $object->getArea();
                $obj['length'] = $object->getLength();
                $obj['gallons'] = $object->getGallons();
                $obj['type'] = $normalice->normalize('normalizer.permittype', $object->getType(), CustomDecorator::DEFAULT_DECORATOR);
                break;
        }

        return $obj;
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }

}

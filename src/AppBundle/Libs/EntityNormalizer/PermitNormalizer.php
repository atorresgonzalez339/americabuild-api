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
                $obj['createdAt'] = $object->getCreatedAt()->format('Y-m-d H:i:s');
                $obj['updatedAt'] = $object->getUpdatedAt()->format('Y-m-d H:i:s');
                $obj['folioNumber'] = $object->getFolioNumber();
                $obj['numberOfUnits'] = $object->getNumberOfUnits();
                $obj['lot'] = $object->getLot();
                $obj['block'] = $object->getBlock();
                $obj['subdivision'] = $object->getSubdivision();
                $obj['pbpg'] = $object->getPbpg();
                $obj['currentUseOfProperty'] = $object->getCurrentUseOfProperty();
                $obj['ownerBuilder'] = $object->getOwnerBuilder();
                $obj['user'] = $normalice->normalize('normalizer.user', $object->getUser(), CustomDecorator::SIMPLE);
                $obj['typeOfImprovement'] = $normalice->normalize('normalizer.permitimprovementtype', $object->getTypeOfImprovement(), CustomDecorator::DEFAULT_DECORATOR);
                break;
        }

        return $obj;
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }

}

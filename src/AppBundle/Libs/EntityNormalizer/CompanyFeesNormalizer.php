<?php

namespace AppBundle\Libs\EntityNormalizer;

use AppBundle\Entity\Usuario;
use AppBundle\Libs\Normalizer\AbstractNormalizer;
use AppBundle\Libs\Decorator\CustomDecorator;

/**
 * Description of CompanyFeesNormalizer
 *
 * @author code
 */
class CompanyFeesNormalizer extends AbstractNormalizer implements \Symfony\Component\DependencyInjection\ContainerAwareInterface {

    private $container;

    public function normalizeObject( $object, $prototype) {

        $obj = array();

        $normalicer = $this->container->get('manager.json');

        switch ($prototype) {
            case CustomDecorator::DEFAULT_DECORATOR:
                $obj['id'] = $object->getId();
                $obj['value'] = $object->getValue();
                $obj['feesCategory'] = $normalicer->normalize('normalizer.feesitem', $object->getFeesItem(), CustomDecorator::DEFAULT_DECORATOR);
                $obj['company'] = $normalicer->normalize('normalizer.company', $object->getCompany(), CustomDecorator::DEFAULT_DECORATOR);
                break;
        }

        return $obj;
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }

}

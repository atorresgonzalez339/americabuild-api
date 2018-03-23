<?php

namespace AppBundle\Libs\EntityNormalizer;

use AppBundle\Entity\Usuario;
use AppBundle\Libs\Normalizer\AbstractNormalizer;
use AppBundle\Libs\Decorator\CustomDecorator;

/**
 * Description of UserPermitProfileNormalizer
 *
 * @author code
 */
class UserPermitProfileNormalizer extends AbstractNormalizer implements \Symfony\Component\DependencyInjection\ContainerAwareInterface {

    private $container;

    public function normalizeObject( $object, $prototype) {

        $obj = array();

        $normalice = $this->container->get('manager.json');

        switch ($prototype) {
            case CustomDecorator::DEFAULT_DECORATOR:
                $obj['id'] = $object->getId();
                $obj['name'] = $object->getName();
                $obj['address1'] = $object->getAddress1();
                $obj['address2'] = $object->getAddress2();
                $obj['city'] = $object->getCity();
                $obj['zip'] = $object->getZip();
                $obj['state'] = $object->getState();
                $obj['phoneNumber'] = $object->getPhoneNumber();
                $obj['email'] = $object->getEmail();
                $obj['driverLicOrId'] = $object->getDriverLicOrId();
                break;
        }

        return $obj;
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }

}

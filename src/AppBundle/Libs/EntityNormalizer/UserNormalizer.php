<?php

namespace AppBundle\Libs\EntityNormalizer;

use AppBundle\Entity\Usuario;
use AppBundle\Libs\Normalizer\AbstractNormalizer;
use AppBundle\Libs\Decorator\CustomDecorator;

/**
 * Description of UserNormalizer
 *
 * @author code
 */
class UserNormalizer extends AbstractNormalizer implements \Symfony\Component\DependencyInjection\ContainerAwareInterface {

    private $container;

    public function normalizeObject( $object, $prototype) {

        $obj = array();

        $normalice = $this->container->get('manager.json');

        switch ($prototype) {
            case CustomDecorator::DEFAULT_DECORATOR:
                $obj['id'] = $object->getId();
                $obj['username'] = $object->getUsername();
                $obj['fullname'] = $object->getFullName();
                $obj['address'] = $object->getAddress();
                $obj['phone'] = $object->getPhoneNumber();
                $obj['licenseNumber'] = $object->getLicenseNumber();
                $obj['role'] = $normalice->normalize('normalizer.role', $object->getRole(), CustomDecorator::DEFAULT_DECORATOR);
                $obj['userType'] = $object->getUserType() != null ? $normalice->normalize('normalizer.usertype', $object->getUserType(), CustomDecorator::DEFAULT_DECORATOR) : null;
                break;
            case CustomDecorator::SIMPLE:
                $obj['id'] = $object->getId();
                $obj['username'] = $object->getUsername();
                $obj['fullname'] = $object->getFullName();
                break;
        }

        return $obj;
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }

}

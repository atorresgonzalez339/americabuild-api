<?php

namespace AppBundle\Libs\EntityNormalizer;

use AppBundle\Libs\Normalizer\AbstractNormalizer;
use AppBundle\Libs\Decorator\CustomDecorator;

/**
 * Description of UserTypeNormalizer
 *
 * @author code
 */
class UserTypeNormalizer extends AbstractNormalizer {

    public function normalizeObject($object, $prototype) {

        $obj = array();
        switch ($prototype) {
            case CustomDecorator::DEFAULT_DECORATOR:
                $obj['id'] = $object->getId();
                $obj['name'] = $object->getName();
                $obj['description'] = $object->getDescription();
                $obj['type'] = $object->getType();
                break;
        }

        return $obj;
    }
}

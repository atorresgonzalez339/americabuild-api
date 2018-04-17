<?php

namespace AppBundle\Libs\EntityNormalizer;

use AppBundle\Libs\Normalizer\AbstractNormalizer;
use AppBundle\Libs\Decorator\CustomDecorator;

/**
 * Description of CountryStatesNormalizer
 *
 * @author code
 */
class CountryStatesNormalizer extends AbstractNormalizer {

    public function normalizeObject($object, $prototype) {

        $obj = array();
        switch ($prototype) {
            case CustomDecorator::DEFAULT_DECORATOR:
                $obj['id'] = $object->getId();
                $obj['code'] = $object->getCode();
                $obj['name'] = $object->getName();
                break;
        }

        return $obj;
    }
}

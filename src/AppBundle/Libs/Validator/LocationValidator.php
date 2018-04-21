<?php

namespace AppBundle\Libs\Validator;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Description of LocationValidator
 *
 * @author code
 */
class LocationValidator extends AbstractValidator {

    private $container;

    public function validate(array $data, $objectPersist, $validationType)
    {
        $parameters = array("latitude","longitude", "zoom");
        foreach ( $parameters as $parameter)
        {
            if ( !isset($data[$parameter]) || empty($data[$parameter]))
            {
                return $this->getTranslator()->trans('validation.parameters.requiered', array("paramname"=>$parameter));
            }
        }
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getTranslator() {
        return $this->container->get('translator');
    }

    public function getContainer(){
        return $this->container;
    }

    public function suportEntityOrData($entity,$data)
    {
        return true;
    }
}

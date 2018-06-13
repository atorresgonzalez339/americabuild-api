<?php

namespace AppBundle\Libs\Validator;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Description of PermitPermitTypeValidator
 *
 * @author code
 */
class PermitPermitTypeValidator extends AbstractValidator {

    private $container;

    public function validate(array $data, $objectPersist, $validationType)
    {
        $parameters = array("permit", "type","descriptionOfWork", "estimateValue", "area", "length", "gallons");
        foreach ( $parameters as $parameter)
        {
            if ( !isset($data[$parameter]) || empty($data[$parameter]))
            {
                return $this->getTranslator()->trans('validation.parameters.requiered', array("paramname"=>$parameter));
            }
        }

        $repoPermitType = $this->container->get('doctrine')->getRepository('AppBundle:PermitType');
        $permitType = $repoPermitType->find($data['type']);
        if (!$permitType)
        {
            return $this->getTranslator()->trans('validation.object.notfound', array("element"=>"permit type"));
        }

        $repoPermitPermitType = $this->container->get('doctrine')->getRepository('AppBundle:PermitPermitType');
        $permitPermitType = $repoPermitPermitType->findBy(array("permit" => $data['permit'], "type" => $data['type']));
        if ($permitPermitType)
        {
            return $this->getTranslator()->trans('validation.permittype.exist');
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

<?php

namespace AppBundle\Libs\Validator;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Description of PermitValidator
 *
 * @author code
 */
class PermitValidator extends AbstractValidator {

    private $container;

    public function validate(array $data, $objectPersist, $validationType)
    {
        $parameters = array("type","folioNumber", "numberOfUnits", "lot", "block", "subdivision", "pbpg", "currentUseOfProperty", "descriptionOfWork", "estimateValue", "area", "length", "typeOfImprovement", "gallons");
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

        $repoPermitImprovementType = $this->container->get('doctrine')->getRepository('AppBundle:PermitImprovementType');
        $permitImprovementType = $repoPermitImprovementType->find($data['typeOfImprovement']);
        if (!$permitImprovementType)
        {
            return $this->getTranslator()->trans('validation.object.notfound', array("element"=>"permit improvement type"));
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

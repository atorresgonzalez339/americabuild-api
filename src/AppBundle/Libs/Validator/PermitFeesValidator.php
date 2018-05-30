<?php

namespace AppBundle\Libs\Validator;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Description of PermitFeesValidator
 *
 * @author code
 */
class PermitFeesValidator extends AbstractValidator {

    private $container;

    public function validate(array $data, $objectPersist, $validationType)
    {
        $parameters = array("value","permitFeesValue", "companyFees", "permit");
        foreach ( $parameters as $parameter)
        {
            if ( !isset($data[$parameter]) || empty($data[$parameter]))
            {
                return $this->getTranslator()->trans('validation.parameters.requiered', array("paramname"=>$parameter));
            }
        }

        $value = $data["value"];
        $data["value"] = floatval($value);
        if ( strval($data["value"]) != $value )
        {
            return $this->getTranslator()->trans('validation.parameter.invalidtype', array("paramname"=>"value", "ptype"=>"float"));
        }

        $value = $data["permitFeesValue"];
        $data["permitFeesValue"] = floatval($value);
        if ( strval($data["permitFeesValue"]) != $value )
        {
            return $this->getTranslator()->trans('validation.parameter.invalidtype', array("paramname"=>"companyFeesValue", "ptype"=>"float"));
        }

        $repoCompanyFees = $this->container->get('doctrine')->getRepository('AppBundle:CompanyFees');
        $companyFees = $repoCompanyFees->find($data['companyFees']);
        if (!$companyFees)
        {
            return $this->getTranslator()->trans('validation.object.notfound', array("element"=>"company fees"));
        }

        $repoPermit = $this->container->get('doctrine')->getRepository('AppBundle:Permit');
        $permit = $repoPermit->find($data['permit']);
        if (!$permit)
        {
            return $this->getTranslator()->trans('validation.object.notfound', array("element"=>"permit"));
        }

        $repoPermitFees = $this->container->get('doctrine')->getRepository('AppBundle:PermitFees');
        $permitFees = $repoPermitFees->findBy(array("permit" => $data['permit'], "companyFees" => $data['companyFees']));
        if ($permitFees)
        {
            return $this->getTranslator()->trans('validation.permitfees.exist');
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

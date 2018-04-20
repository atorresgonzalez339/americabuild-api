<?php

namespace AppBundle\Libs\Validator;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Description of AbstractValidator
 *
 * @author code
 */
class PermitUserProfileValidator extends AbstractValidator {

    private $container;

    public function validate(array $data, $objectPersist, $validationType)
    {
        if ( $validationType == 'contractor' )
        {
            $parameters = array("name","email","address1", "address2", "city", "state", "zip", "phoneNumber", "licenseNumber");
        }
        else
        {
            $parameters = array("name","email","address1", "address2", "city", "state", "zip", "phoneNumber", "driverLicOrId");
        }

        foreach ( $parameters as $parameter)
        {
            if ( !isset($data[$parameter]) || empty($data[$parameter]))
            {
                return $this->getTranslator()->trans('validation.parameters.requiered', array("paramname"=>$parameter));
            }
        }

        if ( filter_var( $data["email"], FILTER_VALIDATE_EMAIL) == false )
        {
            return $this->getTranslator()->trans('validation.email.error');
        }

        if ( !preg_match("/^[0-9]{10}$/",$data['phoneNumber']))
        {
            return $this->getTranslator()->trans('validation.phonenumber.invalid');
        }

        $repoCountryStates = $this->container->get('doctrine')->getRepository('AppBundle:CountryStates');
        $state = $repoCountryStates->find($data['state']);
        if (!$state)
        {
            return $this->getTranslator()->trans('validation.object.notfound', array("element"=>"state"));
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

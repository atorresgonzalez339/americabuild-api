<?php

namespace AppBundle\Controller;

use AppBundle\Libs\Controller\BaseController;
use AppBundle\Listeners\ExceptionListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Libs\Normalizer\ResultDecorator;
use JMS\SecurityExtraBundle\Annotation\Secure;


class CompanyFeesController extends BaseController
{


    /**
     * Return the overall Company Fees list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Company Fees List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/companyfees")
     * @Method({"GET"})
     * @Secure(roles="ROLE_ADMINISTRATOR, ROLE_AUTHENTICATED")
     */
    public function getAllAction()
    {
        $user = $this->getUserOfCurrentRequest();
        if (!$user)
        {
            return $this->returnSecurityViolationResponse();
        }
        $repo = $this->getRepo("CompanyFees");
        $result = $repo->findBy(array("company"=>$user->getCompany()));
        return new View($this->normalizeResult("CompanyFees", $result ), Response::HTTP_OK);
    }

    /**
     * Return the CompanyFees with the provided id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the CompanyFees with the provided id",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/companyfees/{id}")
     * @Method({"GET"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function getByIdAction($id)
    {
        return new View($this->getDataOfModelById('CompanyFees',$id), Response::HTTP_OK);
    }

    /**
     * Create a new CompanyFees
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/companyfees")
     * @Method({"POST"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function postAction(Request $request)
    {
        $data['company'] = $request->get("company");
        $data['feesItem'] = $request->get("feesCategory");
        $data["floatValue"] = $request->get("value");
        $data["value"] = floatval($data["floatValue"]);
        if ( !isset($data['floatValue']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"value"))), Response::HTTP_OK);
        }
        else if ( strval($data["value"]) != $data["floatValue"] )
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.parameter.invalidtype', array("paramname"=>"value", "ptype"=>"float"))), Response::HTTP_OK);
        }
        unset($data["floatValue"]);

        if ( !isset($data['feesItem']) || empty($data['feesItem']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"feesCategory"))), Response::HTTP_OK);
        }

        $repoFeesItem = $this->getRepo("FeesItem");
        $feesItem = $repoFeesItem->find($data['feesItem']);
        if (!$feesItem)
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.object.notfound', array("element"=>"fees item"))), Response::HTTP_OK);
        }

        if ( !isset($data['company']) || empty($data['company']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"company"))), Response::HTTP_OK);
        }

        $repoCompany = $this->getRepo("Company");
        $company = $repoCompany->find($data['company']);
        if (!$company)
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.object.notfound', array("element"=>"company"))), Response::HTTP_OK);
        }

        $save = $this->saveModel('CompanyFees', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a CompanyFees
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/companyfees")
     * @Method({"PUT"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();

        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.updateid.notfound')), Response::HTTP_OK);
        }

        $companyFees = $this->getRepo('CompanyFees')->find($data['id']);

        if (!$companyFees) {
            return new View(array("success" => false, "error" => $this->get('translator')->trans('validation.identifier.invalid', array("value" => "Compnay Fees", "idvalue" => $data["id"]))), Response::HTTP_OK);
        }

        if (isset($data['company']))
        {
            $repoCompany = $this->getRepo("Company");
            $company = $repoCompany->find($data['company']);
            if (!$company)
            {
                return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.object.notfound', array("element"=>"company"))), Response::HTTP_OK);
            }
        }

        if (isset($data['feesCategory']))
        {
            $data['feesItem'] = $data['feesCategory'];
            unset($data['feesCategory']);
            $repoFeesItem = $this->getRepo("FeesItem");
            $feesItem = $repoFeesItem->find($data['feesItem']);
            if (!$feesItem)
            {
                return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.object.notfound', array("element"=>"Fees Item"))), Response::HTTP_OK);
            }
        }

        if (isset($data['value']))
        {
            $value = floatval($data["value"]);
            if ( strval($value) != $data["value"] )
            {
                return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.parameter.invalidtype', array("paramname"=>"value", "ptype"=>"float"))), Response::HTTP_OK);
            }
            else
            {
                $data["value"] = $value;
            }
        }

        $save = $this->saveModel('CompanyFees', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/companyfees/{id}")
     * @Method({"DELETE"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('CompanyFees', $id), Response::HTTP_OK);
    }
}

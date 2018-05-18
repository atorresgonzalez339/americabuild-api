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


class FeesItemController extends BaseController
{


    /**
     * Return the overall FeesItem list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Fees Item List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/feesitem")
     * @Method({"GET"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('FeesItem'), Response::HTTP_OK);
    }

    /**
     * Return the FeesItem with the provided id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the FeesItem with the provided id",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/feesitem/{id}")
     * @Method({"GET"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function getByIdAction($id)
    {
        return new View($this->getDataOfModelById('FeesItem',$id), Response::HTTP_OK);
    }

    /**
     * Create a new FeesItem
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/feesitem")
     * @Method({"POST"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function postAction(Request $request)
    {
        $data['description'] = $request->get("description");
        $data['permitType'] = $request->get("permitType");

        if ( !isset($data['description']) || empty($data['description']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"description"))), Response::HTTP_OK);
        }
        else if ( !isset($data['permitType']) || empty($data['permitType']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.parameters.requiered', array("paramname"=>"permitType"))), Response::HTTP_OK);
        }

        $repoPermitType = $this->getRepo("PermitType");
        $permitType = $repoPermitType->find($data['permitType']);
        if (!$permitType)
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.object.notfound', array("element"=>"permit type"))), Response::HTTP_OK);
        }

        $save = $this->saveModel('FeesItem', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a FeesItem
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/feesitem")
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

        $permitType = $this->getRepo('FeesItem')->find($data['id']);

        if (!$permitType) {
            return new View(array("success" => false, "error" => $this->get('translator')->trans('validation.identifier.invalid', array("value" => "Fees Item", "idvalue" => $data["id"]))), Response::HTTP_OK);
        }

        if (isset($data['permitType']))
        {
            $repoPermitType = $this->getRepo("PermitType");
            $permitType = $repoPermitType->find($data['permitType']);
            if (!$permitType)
            {
                return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.object.notfound', array("element"=>"permit type"))), Response::HTTP_OK);
            }
        }

        $save = $this->saveModel('FeesItem', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/feesitem/{id}")
     * @Method({"DELETE"})
     * @Secure(roles="ROLE_ADMINISTRATOR")
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('FeesItem', $id), Response::HTTP_OK);
    }
}

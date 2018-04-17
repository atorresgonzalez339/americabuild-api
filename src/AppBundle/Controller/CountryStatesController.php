<?php

namespace AppBundle\Controller;

use AppBundle\Libs\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CountryStatesController extends BaseController
{

    /**
     * Return the overall Country States list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Country States List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/states")
     * @Method({"GET"})
     *
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('CountryStates'), Response::HTTP_OK);
    }

    /**
     * Return the Country State with the provided id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the Country State with the provided id",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/states/{id}")
     * @Method({"GET"})
     *
     */
    public function getByIdAction($id)
    {
        return new View($this->getDataOfModelById('CountryStates',$id), Response::HTTP_OK);
    }

    /**
     * Create a new Country State
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/states")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $data["code"] = $request->get("code");
        $data["name"] = $request->get("name");

        $save = $this->saveModel('CountryStates', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a Country State
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/states")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();

        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.updateid.notfound')), Response::HTTP_OK);
        }
        $permitType = $this->getRepo('CountryStates')->find($data['id']);

        if (!$permitType)
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.identifier.invalid', array("value"=>"Country State", "idvalue"=>$data["id"]))), Response::HTTP_OK);

        $save = $this->saveModel('CountryStates', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/states/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('CountryStates', $id), Response::HTTP_OK);
    }
}

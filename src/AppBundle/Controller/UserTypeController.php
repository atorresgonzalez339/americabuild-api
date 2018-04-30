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

class UserTypeController extends BaseController
{

    /**
     * Return the overall UserType list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall UserType List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/usertypes")
     * @Method({"GET"})
     *
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('UserType'), Response::HTTP_OK);
    }

    /**
     * Return the UserType with the provided id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the UserType with the provided id",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/usertypes/{id}")
     * @Method({"GET"})
     *
     */
    public function getByIdAction($id)
    {
        return new View($this->getDataOfModelById('UserType',$id), Response::HTTP_OK);
    }

    /**
     * Create a new UserType
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/usertypes")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $data["name"] = $request->get("name");
        $data["description"] = $request->get("description");
        $data["type"] = $request->get("type");

        $save = $this->saveModel('UserType', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a UserType
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/usertypes")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();

        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.updateid.notfound')), Response::HTTP_OK);
        }
        $userType = $this->getRepo('UserType')->find($data['id']);

        if (!$userType)
            return new View(array("success"=>false,"error"=>$this->get('translator')->trans('validation.identifier.invalid', array("value"=>"User Type", "idvalue"=>$data["id"]))), Response::HTTP_OK);

        $save = $this->saveModel('UserType', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/usertypes/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('UserType', $id), Response::HTTP_OK);
    }
}

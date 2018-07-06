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

class PermitTypeController extends BaseController
{

    /**
     * Return the overall PermitType list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall PermitType List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/permittypes")
     * @Method({"GET"})
     *
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('PermitType'), Response::HTTP_OK);
    }

    /**
     * Return the PermitType with the provided id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the PermitType with the provided id",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/permittypes/{id}")
     * @Method({"GET"})
     *
     */
    public function getByIdAction($id)
    {
        return new View($this->getDataOfModelById('PermitType', $id), Response::HTTP_OK);
    }

    /**
     * Return the PermitType of the permit with the provided id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the PermitType of the permit with the provided id",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/permittypes/permit/{id}")
     * @Method({"GET"})
     *
     */
    public function getByPermitAction($id)
    {
        $data = $this->getRepo('PermitType')->getByPermit($id);
        return new View($this->normalizeResult('PermitType', $data), Response::HTTP_OK);
    }

    /**
     * Create a new PermitType
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/permittypes")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $data["name"] = $request->get("name");
        $data["description"] = $request->get("description");
        $data["type"] = $request->get("type");

        $save = $this->saveModel('PermitType', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a PermitType
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/permittypes")
     * @Method({"PUT","OPTIONS"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();

        if (!isset($data['id'])) {
            return new View(array("success" => false, "error" => $this->get('translator')->trans('validation.updateid.notfound')), Response::HTTP_OK);
        }
        $permitType = $this->getRepo('PermitType')->find($data['id']);

        if (!$permitType)
            return new View(array("success" => false, "error" => $this->get('translator')->trans('validation.identifier.invalid', array("value" => "Permit Type", "idvalue" => $data["id"]))), Response::HTTP_OK);

        $save = $this->saveModel('PermitType', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/permittypes/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('PermitType', $id), Response::HTTP_OK);
    }
}

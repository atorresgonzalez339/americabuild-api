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
use AppBundle\Libs\Normalizer\ResultDecorator;
use JMS\SecurityExtraBundle\Annotation\Secure;

class RoleController extends BaseController {

    /**
     * Return the overall Role list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Role List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/roles")
     * @Method({"GET","OPTIONS"})
     */
    public function getAllAction() {
        return new View($this->getAllDataOfModel('Role'), Response::HTTP_OK);
    }

    /**
     *
     * Update a Role
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/roles")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();
        unset($data["rolname"]);
        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>"No role identifier provided to performe the update action"), Response::HTTP_OK);
        }
        $user = $this->getRepo('Role')->find($data['id']);
        if (!$user)
            return new View(array("success"=>false,"error"=>"Role identifier not found"), Response::HTTP_OK);

        $save = $this->saveModel('Role', $data);
        return new View($save, Response::HTTP_OK);
    }
}

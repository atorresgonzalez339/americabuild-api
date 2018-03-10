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
use JMS\SecurityExtraBundle\Annotation\Secure;


class CompanyController extends BaseController
{


    /**
     * Return the overall Companies list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Companies List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/companies")
     * @Method({"GET","OPTIONS"})
     *
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('Company'), Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/companies/{id}")
     * @Method({"DELETE","OPTIONS"})
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('Company', $id), Response::HTTP_OK);
    }

    /**
     * Create a new Company
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/companies")
     * @Method({"POST","OPTIONS"})
     */
    public function postAction(Request $request)
    {
        $data["companyName"] = $request->get("companyName");
        $data["subdomain"] = $request->get("subdomain");
        $save = $this->saveModel('Company', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a Company
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/companies")
     * @Method({"PUT","OPTIONS"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();

        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>"No company identifier provided to performe the update action"), Response::HTTP_OK);
        }
        $user = $this->getRepo('Company')->find($data['id']);

        if (!$user)
            return new View(array("success"=>false,"error"=>"Company identifier not found"), Response::HTTP_OK);

        $save = $this->saveModel('Company', $data);
        return new View($save, Response::HTTP_OK);
    }
}

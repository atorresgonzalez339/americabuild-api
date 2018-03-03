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
}

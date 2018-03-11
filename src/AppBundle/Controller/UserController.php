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


class UserController extends BaseController
{


    /**
     * Return the overall User list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall User List",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Get("/api/users")
     * @Method({"GET"})
     *
     */
    public function getAllAction()
    {
        return new View($this->getAllDataOfModel('User'), Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/users/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        return new View($this->removeModel('User', $id), Response::HTTP_OK);
    }

    /**
     * Create a new User
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of new resource create",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Post("/api/users/register")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $data["username"] = $request->get("username");
        $data["password"] = $request->get("password");
        $data["fullname"] = $request->get("fullname");
        $repassword = $request->get("repassword");

        if ( filter_var( $data["username"], FILTER_VALIDATE_EMAIL) == false )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.email.error')), Response::HTTP_OK);
        }

        if ( $data['password'] != $repassword )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.password.notmatch')), Response::HTTP_OK);
        }
        $data["role"] = 2; //AUTHENTICATE_USER
        $data["active"] = false;
        $data["company"] = $request->get("company",1);
        //var_dump($data['company']);
        $company = $this->getRepo('Company')->find($data['company']);
        //var_dump($company);
        if ( !$company )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.company.notfound')), Response::HTTP_OK);
        }
        /*
        $domainName = substr(strrchr( $data["username"], "@"), 1);
        if ( $company->getSubDomain() != $domainName )
        {
            return new View(array('success' => false, 'error' => $this->get('translator')->trans('validation.usercompany.subdomain',array("invalidemail" => $data["username"]))), Response::HTTP_OK);
        }
        */

        $save = $this->saveModel('User', $data);
        return new View($save, Response::HTTP_OK);
    }

    /**
     *
     * Update a User
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an object with property success to inform the result of response an data array with id of resource update",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\Put("/api/users")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = $request->request->all();
        unset($data["username"]);
        unset($data["password"]);
        unset($data["salt"]);
        unset($data["token"]);
        if (!isset($data['id']))
        {
            return new View(array("success"=>false,"error"=>"No user identifier provided to performe the update action"), Response::HTTP_OK);
        }
        $user = $this->getRepo('User')->find($data['id']);
        if (!$user)
            return new View(array("success"=>false,"error"=>"User identifier not found"), Response::HTTP_OK);

        $save = $this->saveModel('User', $data);
        return new View($save, Response::HTTP_OK);
    }
}
